<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class UsuarioControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/UserDAO' );
			$this->load->Model( 'dao/ContatoDAO' );
            $this->load->Model( 'dao/EmailDAO' );
            $this->load->Model( 'dao/TelefoneDAO' );
            $this->load->Model( 'dao/LocalidadeDAO' );
            $this->load->Model( 'dao/InstituicaoDAO' );
			$this->load->Model('UserModel','usuario');
            $this->load->Model('dao/EdicaoDAO');
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
                $this->instituicao = $this->InstituicaoDAO->
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
            if($this->session->userdata('usuario')[0]['user_tipo']!=3||
                  ($this->session->userdata('usuario')[0]['user_tipo']==3 &&
                    empty($this->input->post('confirmaemail')))){
                    $this->email->email_email = $data['email']->email_email;
               }

            if($this->form_validation->run()){
                $this->db->trans_start();
                $this->usuario->user_cd = $data['user']->user_cd;
                $verificaTel = $this->TelefoneDAO->verificaTelefoneExiste($this->telefone->tele_fone);
                if(null === $data['user']->user_tele_cd){
                    $this->usuario->user_tele_cd = $this->TelefoneDAO->inserir($this->telefone);
                }else if($verificaTel!=null){
                    $this->usuario->user_tele_cd = $verificaTel;
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
                        $this->TelefoneDAO->alterar($this->telefone);
                    }
                }

                if($data['user']->user_cpf === null){
                    $this->usuario->user_cpf = $this->input->post('cpf');
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
            $limite = 10;
            $numPagina =0;
            if(null !== $this->input->get('pagina')){
                $numPagina = $this->input->get('pagina');
            }

            if( $this->input->get('busca') !== null){
                $busca = $this->input->get('busca');
                $array = array('user_nm'=>$busca);
            }else{
                $busca=null;
                $array=null;
            }

            $data['users']=$this->UserDAO->consultarTudo($array, $limite, $numPagina);
            $data['paginacao'] = $this->geraPaginacao($limite, $this->UserDAO->totalRegistros(), 'usuario/consultar/?busca='.$busca);
            $data['totalRegistros'] = $this->UserDAO->totalRegistros();
            $data['title']="IFEvents - Usuários";
            $this->chamaView("usuarios", "organizador", $data, 1);
        }

		public function consultarTudo(){
			return null;
		}

<<<<<<< HEAD
        public function notificaUsers(){
			$data['content'] = $this->ContatoDAO->consultarCodigo($this->uri->segment(3));
            if (empty($this->input->post())){
                $this->chamaView("notifica-users", "organizador",
                    array("title"=>"IFEvents - Nova Notificação"), 1);
                return true;
            }
			$answer  = (object) array(
				'resposta' => $this->input->post('tipo'));

            $notificacao = (object) array(
                'tipo_notificacao' => $this->input->post('tipo_notificacao'),
                'emails' => $this->input->post('emails'),
                'assunto' => $this->input->post('assunto'),
                'mensagem' => $this->input->post('mensagem'));
            $this->form_validation->set_rules( 'tipo_notificacao', 'Notificar', 'trim|required|max_length[11]' );
            if($notificacao->tipo_notificacao == 1){
                $this->form_validation->set_rules( 'emails[]', 'Emails', 'valid_emails|trim|required|max_length[100]' );
            }
            $this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );
            $this->form_validation->set_rules( 'mensagem', 'Mensagem', 'required' );
            $users = null;
            if($notificacao->tipo_notificacao != 1 && $notificacao->tipo_notificacao != -1){
                switch ($notificacao->tipo_notificacao) {
                    case '2':
                        $users = $this->UserDAO->consultarTudo(array('user_tipo' => 1));
                        break;

                    case '3':
                        $users = $this->UserDAO->consultarTudo(array('user_tipo' => 2));
                        break;

                    case '4':
                        $users = $this->UserDAO->consultarTudo(array('user_tipo' => 3));
                        break;

                    default:
                        $users = $this->UserDAO->consultarTudo(null);
                        break;
                }
            }
            if($this->form_validation->run()){
                $test=1;
                $qtd=0;
                if(!empty($notificacao->emails)){
                    $qtd= sizeof($notificacao->emails);
                    foreach ($notificacao->emails as $key => $value) {
                        $test = $this->envia_email($value,$notificacao->assunto, $notificacao->mensagem);
                    }
                }
                if($users != null){
                    $qtd= sizeof($users);
                    foreach ($users as $key => $value) {
                        $test = $this->envia_email($value->email_email, $notificacao->assunto, $notificacao->mensagem);
                    }
                }
                if($test == 0){
                    if($qtd > 1){
                        $mensagem = 'As notificações foram enviados com sucesso!';
                    }else{
                        $mensagem = 'A notificação foi enviada com sucesso!';
						if($answer->resposta == 'resposta'){
							redirect('contato/consultarTudo');
						}
                    }
                    $this->session->set_flashdata('success', $mensagem);
                }else{
                    if($qtd > 1){
                        $mensagem = 'Não foi possível enviar as notificações!';
                    }else{
                        $mensagem = 'Não foi possível enviar a notificação!';
                    }
                    $this->session->set_flashdata('error', $mensagem);
                }
            }
            $data['title']="IFEvents - Nova Notificação";
            $data['notificacao'] = $notificacao;
            $this->chamaView("notifica-users", "organizador",
                   $data, 1);
        }

=======
>>>>>>> a04aa208aed25cef92631e3d0db2ae34358dc71b
        public function consultarEmailSelect(){
            $data = $this->UserDAO->consultarTudo(array('Email.email_email' => $this->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        //busca usuário por nome
        public function consultarParaSelect2(){
            $data = $this->UserDAO->consultarTudo(array('User.user_nm' => $this->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }


        public function ativar($user_cd){
            if(!empty($user_cd)){
                 if($this->UserDAO->ativaDesativa($user_cd, 2)==0){
                    $this->session->set_flashdata('success','O Usuário foi ativado com sucesso!');
                 }else{
                    $this->session->set_flashdata('error','Não foi possível ativar o Usuário!');
                 }
            }
             $this->consultar();
        }

        public function desativar($user_cd){
            if(!empty($user_cd)){
                 if($this->UserDAO->ativaDesativa($user_cd, 3)==0){
                    $this->session->set_flashdata('success','O Usuário foi desativado com sucesso!');
                 }else{
                    $this->session->set_flashdata('error','Não foi possível desativar o Usuário!');
                 }
            }
             $this->consultar();
        }

        public function consultarRevisorSelect2(){
            $data = $this->UserDAO->consultarTudo(array('user_nm' => $this->input->post('term'), 'user_tipo' => 2));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }


        public function excluir($codigo) {

        }



}
