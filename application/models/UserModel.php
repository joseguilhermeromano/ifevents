<?php
	if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );
        
        include_once 'InterfaceModel.php';
        
	class UserModel extends CI_Model implements InterfaceModel{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/UserDAO' );
			//$this->load->library( 'session' );
		}

		//Método valida os campos do formulário cadastro de participantes
		public function verifica(){			
			$this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|required|max_length[100]' );
			$this->form_validation->set_rules( 'fone', 'Telefone', 'trim|required|max_length[15]' );
			$this->form_validation->set_rules( 'email', 'Email', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|max_length[15]' );			
			$this->form_validation->set_rules( 'valida', 'Valida Email', 'trim|required|max_length[10]' );
			$this->form_validation->set_rules( 'status', 'Status', 'trim|max_length[2]' );

			if( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('empty', 'Por Favor Preencha Todos Os Campos');
				redirect( 'cadastro' );
				
			}
			else{
				
				$nome         = $this->input->post( 'nome' );
				$instituicao  = $this->input->post( 'instituicao' );
				$fone         = $this->input->post( 'fone' );
				$email        = $this->input->post( 'email' );
				$pass  	      = $this->input->post( 'senha' );
				$tipo         = 0;
				$valida       = $this->input->post( 'valida' );
				$status       = $this->input->post( 'status' );

				$this->UserDAO->cadastrar( $nome, $instituicao, $fone, $email, $pass, $tipo, $valida, $status );
				
			}
	}
        
        public function cadastrar() {
            return true;
        }

        public function alterar() {
            return true;
        }

        public function buscar() {
            return null;
        }

        public function buscarTudo() {
            return null;
        }

        public function excluir() {
            return true;
        }

}	