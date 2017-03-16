<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';

class UsuarioControl extends PrincipalControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/UserDAO' );
			$this->load->Model('UserModel','usuario');
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

		public function perfil(){
			$this->chamaView("meuperfil", "organizador",
	            	array("title"=>"IFEvents - Meu Perfil - Organizador"), 1);
		}

       
        
        public function cadastrar() {
        	if (empty($this->usuario->input->post())){
        		$this->chamaView("novo-usuario", "organizador",
	            	array("title"=>"IFEvents - Novo Usuário"), 1);
        		return true;
        	}
            $this->usuario->setaValores();
            if( $this->usuario->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                if($this->UserDAO->inserir($this->usuario)==true){
                    $this->session->set_flashdata('success', 'O Usuário foi cadastrado com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível cadastrar o usuário!');
                }

            }
            $this->chamaView("novo-usuario", "organizador",
	            	array("title"=>"IFEvents - Novo Usuário"), 1);
        }

        public function alterar() {
            $this->usuario->setaValores();
            if( $this->usuario->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                if($this->UserDAO->alterar($this->usuario)==true){
                    $this->session->set_flashdata('success', 'O Usuário foi atualizado com sucesso!');
                     $this->UserDAO->consultarCodigo($this->usuario->user_id);
                    
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível atualizar o usuário!');
                }

            }
            $array[0]= (array)$this;
        }

        public function buscar() {
            $this->UserDAO->consultarCodigo($this->usuario->input->get('codigo'));
        }

        public function buscarTudo() {
            $this->chamaView("usuarios", "organizador",
	            	array("title"=>"IFEvents - Usuários"), 1);
        }

        public function excluir() {
            
        }



}