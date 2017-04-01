<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class UsuarioControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/UserDAO' );
            $this->load->Model( 'dao/EmailDAO' );
            $this->load->Model( 'dao/TelefoneDAO' );
            $this->load->Model( 'dao/LocalidadeDAO' );
            $this->load->Model( 'dao/InstituicaoDAO' );
			$this->load->Model('UserModel','usuario');
            $this->load->Model('EmailModel','email');
            $this->load->Model('TelefoneModel','telefone');
            $this->load->Model('LocalidadeModel','localidade');
            $this->load->Model('InstituicaoModel','instituicao');
		}


		public function inicioOrganizador(){

			$this->chamaView("index", "organizador",
	            	array("title"=>"IFEvents - Início - Organizador"), 1);
		}

		public function inicioAvaliador(){

			$this->chamaView("index", "avaliador",
	            	array("title"=>"IFEvents - Início - Avaliador"), 1);
		}

		public function inicioParticipante(){
			$this->chamaView("index", "participante",
	            	array("title"=>"IFEvents - Início - Participante"), 1);
		}

       
        
        public function cadastrar() {

        	if (empty($this->usuario->input->post())){
        		$this->chamaView("novo-usuario", "organizador",
	            	array("title"=>"IFEvents - Novo Usuário"), 1);
        		return true;
        	}

            $this->usuario->setaValores();
            $this->email->setaValores();
            $this->telefone->setaValores();
            $this->localidade->setaValores();

            $this->usuario->valida(); 
            $this->email->valida();
            $this->telefone->valida();
            $this->localidade->valida();

            if((null != $this->input->post('instituicao')) &&
                !empty($this->input->post('instituicao'))){
                $this->instituicao = (object)$this->InstituicaoDAO->
                    consultarCodigo($this->input->post('instituicao'))[0];
            }

            $view = $this->session->userdata('view'); 
            $nomeDiretorio = $this->session->userdata('nomeDiretorio'); 
            $titulo = $this->session->userdata('title'); 
            $areaTemplate = $this->session->userdata('areaTemplate'); 

            if($this->form_validation->run()){
                    $this->db->trans_start();
                    try{
                        $email_cd = $this->EmailDAO->inserir($this->email);
                        $tele_cd = $this->TelefoneDAO->inserir($this->telefone);
                        $this->usuario->user_email_cd = $email_cd;
                        $this->usuario->user_tele_cd = $tele_cd;
                        $user_cd = $this->UserDAO->inserir($this->usuario);
                        $this->LocalidadeDAO->inserirEnderecoUser($this->localidade, $user_cd);
                    }catch(Exception $e){
                        $this->session->set_flashdata('error', $e->getMessage());
                    }
                    $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O Usuário foi cadastrado com sucesso!');
                    $this->usuario = null;
                    $this->email = null;
                    $this->telefone = null;
                    $this->localidade = null;
                    $this->instituicao = null;
                            
                }
            }
             $data = array("title"=>$titulo, 
                "user" => $this->usuario, "email" => $this->email,
                "telefone" => $this->telefone, "localidade" => $this->localidade, "instituicao" => $this->instituicao);
            $this->chamaView($view, $nomeDiretorio, $data, $areaTemplate);
        }


        //Chama view alterar do organizador
        public function alterar($codigo) {
            if (isset($codigo)){
                $data = $this->UserDAO->consultarCodigo($codigo);
                if(!empty($this->input->post())){
                    $data = $this->atualizaUsuario($data);
                }
                 $data['title'] = "IFEvents - Atualizar Registro de Usuário!";
                $this->chamaView("edita-usuario", "organizador", $data, 1);
                return true;
            }
            // $data['title'] = "IFEvents - Registros de Usuários!";
            // $this->chamaView("edita-usuario", "organizador", $data, 1);  
        }

        //Procedimentos para alterar perfil de usuário
        public function perfil() {
            if (null !== $this->session->userdata('usuario')){
                $user = $this->session->userdata('usuario'); 
                $data = $this->UserDAO->consultarCodigo($user[0]['user_cd']);
                if(empty($this->input->post())){
                    $data['title'] = "IFEvents - Atualizar Registro de Usuário!";
                    $this->chamaView("meuperfil", "usuario", $data, 1);
                    return true;
                }
                $data = $this->atualizaUsuario($data);
                $data['title'] = "IFEvents - Meu Perfil";
                $this->chamaView("meuperfil", "usuario", $data, 1);
            }else{
             $this->session->set_flashdata('error','Você está deslogado!');
             $data['title'] = "IFEvents - Login";
             $this->chamaView("login", "inicio", $data, 0);
         }
        }


        //Executa as operações de alteração
        private function atualizaUsuario($data){
            $this->usuario->setaValores(false);
            $this->email->setaValores(false);
            $this->telefone->setaValores();
            $this->localidade->setaValores();

            $this->usuario->valida(false); 
            $this->email->valida(false);
            $this->telefone->valida();
            $this->localidade->valida();
            if((null != $this->input->post('instituicao')) &&
                !empty($this->input->post('instituicao'))){
                $this->instituicao = (object)$this->InstituicaoDAO->
                    consultarCodigo($this->input->post('instituicao'))[0];
            }

            if($this->form_validation->run()){
                $this->db->trans_start();
                $this->usuario->user_cd = $data['user']->user_cd;

                if(null === $data['user']->user_tele_cd){
                    $this->usuario->user_tele_cd = $this->TelefoneDAO->inserir($this->telefone);
                }else if($data['telefone']->tele_fone != $this->telefone->tele_fone){
                    $users = $this->UserDAO->consultarTudo();
                    $numusers=0;
                    foreach ($users as $key => $value) {
                        $value->user_tele_cd == $data['user']->user_tele_cd ? $numusers++ :'';
                    }
                    if($numusers > 1){
                        $this->usuario->user_tele_cd = $this->TelefoneDAO->inserir($this->telefone);
                    }else{
                        $this->usuario->user_tele_cd = $data['user']->user_tele_cd;
                        $this->telefone->tele_cd = $data['user']->user_tele_cd;
                        $this->TelefoneDAO->alterarTelefoneUser($this->telefone);
                    }
                }

                if($data['user']->user_cpf === null){
                    $this->usuario->user_cpf = $this->input->post('cpf');
                }

                if($this->session->userdata('usuario')[0]['user_tipo']!=3||
                  ($this->session->userdata('usuario')[0]['user_tipo']==3 &&
                    empty($this->input->post('confirmaemail')))){
                    $this->email->email_email = $data['email']->email_email;
                }

                $this->UserDAO->alterar($this->usuario);
                $this->LocalidadeDAO->alterarEnderecoUser($this->localidade, $data['user']->user_cd);
                $this->email->email_cd = $data['user']->user_email_cd;
                $this->EmailDAO->alterar($this->email);
                $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O Usuário foi atualizado com sucesso!');
                     $data = $this->UserDAO->consultarCodigo($data['user']->user_cd);
                     $data['title'] = "IFEvents - Atualizar Registro de Usuário!";
                     return $data;
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível atualizar o usuário!');
                }
            }
             $data = array( "user" => $this->usuario, "email" => $this->email,
                "telefone" => $this->telefone, "localidade" => $this->localidade, "instituicao" => $this->instituicao);
            return $data;
        }

        public function consultar() {
            $this->UserDAO->consultarCodigo($this->usuario->input->get('codigo'));
        }

        public function consultarTudo() {
            $this->chamaView("usuarios", "organizador",
	            	array("title"=>"IFEvents - Usuários"), 1);
        }

        public function excluir() {
            
        }



}