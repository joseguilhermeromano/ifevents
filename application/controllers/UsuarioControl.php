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
            $emails = $this->email->criaLista(null);
            $telefones = $this->telefone->criaLista(null);
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
                $user_cd = $this->UserDAO->inserir($this->usuario);
                $this->LocalidadeDAO->inserirEnderecoUser($this->localidade, $user_cd);
                    foreach($this->email->criaLista($user_cd) as $key => $email){
                        $this->EmailDAO->inserir($email);
                    }
                    foreach($this->telefone->criaLista($user_cd) as $key => $tel){
                        $this->TelefoneDAO->inserir($tel);
                    }
                    $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O Usuário foi cadastrado com sucesso!');
                    $this->usuario = null;
                    $emails = null;
                    $telefones = null;
                    $this->localidade = null;
                    $this->instituicao = null;
                            
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível cadastrar o usuário!');
                }
            }
             $data = array("title"=>$titulo, 
                "user" => $this->usuario, "emails" => $emails,
                "telefones" => $telefones, "localidade" => $this->localidade, "instituicao" => $this->instituicao);
            $this->chamaView($view, $nomeDiretorio, $data, $areaTemplate);
        }


        //Chama view alterar do organizador
        public function alterar($codigo) {
            if (isset($codigo) && empty($this->input->post())){
                $data = $this->UserDAO->consultarCodigo($codigo);
                $data['title'] = "IFEvents - Atualizar Registro de Usuário!";
                $this->chamaView("edita-usuario", "organizador", $data, 1);
                return true;
            }
            $data = $this->atualizaUsuario($codigo);
            $data['title'] = "IFEvents - Atualizar Registro de Usuário!";
            $this->chamaView("edita-usuario", "organizador", $data, 1);  
        }

        //Procedimentos para alterar perfil de usuário
        public function perfil() {
            if (null !== $this->session->userdata('usuario') && empty($this->input->post())){
                $user = $this->session->userdata('usuario'); 
                $data = $this->UserDAO->consultarCodigo($user[0]['user_cd']);
                $data['title'] = "IFEvents - Atualizar Registro de Usuário!";
                $this->chamaView("meuperfil", "usuario", $data, 1);
                return true;
            }
            $data = $this->atualizaUsuario($this->session->userdata('usuario')[0]['user_cd']);
            $data['title'] = "IFEvents - Meu Perfil";
            $this->chamaView("meuperfil", "usuario", $data, 1);  
        }


        //Executa as operações de alteração
        private function atualizaUsuario($user_cd){
            $this->usuario->setaValores(false);
            $emails = $this->input->post('email');
            $telefones = $this->input->post('telefone');
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
                $this->usuario->user_cd = $user_cd;
                $this->UserDAO->alterar($this->usuario);
                $this->LocalidadeDAO->excluir($user_cd);
                $this->LocalidadeDAO->inserirEnderecoUser($this->localidade, $user_cd);
                $this->EmailDAO->excluir($user_cd);
                foreach($this->email->criaLista($user_cd,false) as $key => $email){
                    $this->EmailDAO->inserir($email);
                }
                $this->TelefoneDAO->excluir($user_cd);
                foreach($this->telefone->criaLista($user_cd) as $key => $tel){
                    $this->TelefoneDAO->inserir($tel);
                }
                $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O Usuário foi atualizado com sucesso!');
                     $data = $this->UserDAO->consultarCodigo($user_cd);
                     $data['title'] = "IFEvents - Atualizar Registro de Usuário!";
                     return $data;
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível atualizar o usuário!');
                }
            }
             $data = array( "user" => $this->usuario, "emails" => $emails,
                "telefones" => $telefones, "localidade" => $this->localidade, "instituicao" => $this->instituicao);
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