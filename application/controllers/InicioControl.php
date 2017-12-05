<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
	require_once 'PrincipalControl.php';

	class InicioControl extends PrincipalControl{

		/*Método construtor faz o carregamento de vários componentes
		necessários ao funcionamento do sistema*/

		public function __construct(){
			parent::__construct();
			// $this->load->model('dao/DataBaseDAO');
//			$this->DataBaseDAO->create_table_ci_session();
			$this->load->model('dao/InscricaoDAO');
                        $this->load->model('dao/AtividadeDAO');
                        $this->load->model('dao/UsuarioDAO');
			$this->load->model('dao/TipoAtividadeDAO');
		}
		//Método chama a view principal do sistema (Home)
		public function index(){
                    $data = array("title"=>"IFEvents - Página Inicial - Seja bem vindo!");
                    $data['tresUltimosEventos']  = $this->EdicaoDAO->consultarTudo(null,3, null, 'edic_cd','desc');
                    $data['todasEdicoes'] = $this->EdicaoDAO->consultarTudo();
                    $data['todasConferencias'] = $this->ConferenciaDAO->consultarTudo();
                    $this->chamaView("index", "inicio",$data, 0);
		}

		public function sobre(){

			$this->chamaView("sobre", "inicio",
            	array("title"=>"IFEvents - Sobre"), 0);
		}

		public function evento(){
            $data = array("title"=>"IFEvents - Sobre o Evento");
            $uri = $this->uri->uri_string();
            $this->session->set_userdata("link_evento_selecionado", $uri);
            $evento = $this->EdicaoDAO->consultarPorLink($uri);
            $data['evento'] = $evento;
            $data= $this->programacao($data,$evento->getCodigo());
            $this->chamaView("evento", "inicio",$data, 0);
		}


		private function programacao($data, $codigoEvento){
            $array = array('ativ_edic_cd' => $codigoEvento);
            $data['programacoes'] = $this->AtividadeDAO->consultarTudo($array);
            $data['DiasSemana'] = $this->AtividadeDAO->consultarDiasSemanaProgramacao($codigoEvento);
            return $data;
		}

        //Método que chama a view do login
        public function login(){

            $this->chamaView("login", "inicio",
                array("title"=>"IFEvents - Login"), 0);
        }


		public function esqueciMinhaSenha(){
                    $email = $this->input->post("email");
                    if($email === null){
                        return $this->chamaView("esqueci_senha", "inicio",
                        array("title"=>"IFEvents - Esqueci minha senha"), 0);
                    }
                    $consulta = array('user_nm' => null, 'email_email' => $email);
                    $usuario = $this->UsuarioDAO->consultarTudo($consulta, 1)[0];
                    if(!empty($usuario)){
                        $this->disparaEmailRedefinicaoSenha($usuario);
                    }else{
                        $this->session->set_flashdata('error', 'Não existe em nossa base de dados '
                        . 'um usuário com este mesmo endereço de e-mail!');
                    }
                    $this->chamaView("esqueci_senha", "inicio",
                        array("title"=>"IFEvents - Esqueci minha senha"), 0);
		}
                
                private function disparaEmailRedefinicaoSenha($usuario){
                    $linkValidcao = base_url("redefinir-senha?token=".$usuario->user_token);
                    $mensagem = "Caro(a) <b>".$usuario->user_nm."</b>, este e-mail se refere "
                    . "a redefinião de senha da sua conta de usuário da plataforma <b>IFEVENTS!</b><br>"
                    .'Por favor, <a href ="'.$linkValidcao.'"> Clique aqui </a>'
                    . ' para redefinir a sua senha!';
                    $dataMensagem = array("tituloMensagem" => "Redefinição de Senha"
                        ,"corpoMensagem" => $mensagem);
                    $htmlMensagem = $this->load->view("template-email/template-email", $dataMensagem, true);
                    $test = $this->envia_email($usuario->email_email
                    , 'Redefinição de senha de usuário da plataforma IFEVENTS'
                    , $htmlMensagem);
                    if($test){
                        $this->session->set_flashdata('success','Um e-mail de redefinição'
                        . ' de senha foi enviado para '
                        . '<b>'.$usuario->email_email.'</b>! Por favor, '
                        . 'verifique a mensagem na sua caixa de entrada!');
                    }else{
                        $this->session->set_flashdata('error', 'Não foi possível enviar o e-mail'
                        . ' de redefinião de senha para <b>'.$usuario->email_email.'</b>!');
                    }
                }
                
                public function redefinirSenha(){
                    $senha = $this->input->post("novasenha");
                    $confirma = $this->input->post("confirmasenha");
                    $token = $this->input->get("token");
                    if($token === null){
                        $this->session->set_flashdata('error', 'Não foi possível redefinir sua senha '
                        . 'pois não o identificamos!');
                        $this->chamaView("erro-sucesso-redefinicao-senha", "inicio",
                        array("title"=>"IFEvents - Redefinição de Senha"), 0);
                    }
                    if($senha === null || $confirma === null){
                        return $this->chamaView("redefinir_senha", "inicio",
                        array("title"=>"IFEvents - Redefinição de senha"), 0);
                    }
                    if($senha != $confirma){
                        $this->session->set_flashdata('error', 'As senhas informadas são diferentes!');
                        return $this->chamaView("redefinir_senha", "inicio",
                        array("title"=>"IFEvents - Redefinição de senha"), 0);
                    }
                    $novaSenha = md5($senha);
                    
                    $this->db->trans_start();
                    try{
                        $this->UsuarioDAO->redefinirSenha($token, $novaSenha);
                    }catch(Exception $e){
                        $this->session->set_flashdata('error', $e->getMessage());
                    }
                    $this->db->trans_complete();
                    if($this ->db->trans_status() === TRUE){
                        $this->session->set_flashdata('success', 'Senha Redefinida com sucesso!');
                    }else{
                        $this->session->set_flashdata('error', 'Não foi possível redefinir a senha! '
                        . 'Tente novamente mais tarde!');
                    }
                    
                    $this->chamaView("erro-sucesso-redefinicao-senha", "inicio",
                        array("title"=>"IFEvents - Redefinição de Senha"), 0);
                    
                }

		public function noPermission(){
			$this->chamaView("noPermission", "inicio",
            	array("title"=>"IFEvents - Erro de Permissão"), 0);
		}

}
