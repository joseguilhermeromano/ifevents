<?php
	if ( ! defined( "BASEPATH" )) exit( 'No direct script access allowed' );

	class UserModel extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		//Método valida os campos do formulário cadastro de participantes
		public function verifica(){

			$this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules( 'inst_empresa', 'Instituição/Empresa', 'trim|required|max_length[100]' );
			$this->form_validation->set_rules( 'fone', 'Telefone', 'trim|required|max_length[15]' );
			$this->form_validation->set_rules( 'email', 'Email', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|max_length[15]' );
			$this->form_validation->set_rules( 'tipo', 'Tipo de Usuário', 'trim|required|max_length[1]' );
			$this->form_validation->set_rules( 'valida', 'Valida Email', 'trim|required|max_length[10]' );
			$this->form_validation->set_rules( 'status', 'Status', 'trim|required|max_length[2]' );

			if( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('empty', 'Por Favor Preencha Todos Os Campos');
				redirect( 'InicioControl/cadastro' );
				
			}
			else{
				
				$nome      = $this->input->post( 'nome' );
				$inst_emp  = $this->input->post( 'inst_empresa' );
				$fone      = $this->input->post( 'fone' );
				$email     = $this->input->post( 'email' );
				$pass  	   = $this->input->post( 'senha' );
				$tipo      = $this->input->post( 'tipo' );
				$val_email = $this->input->post( 'valida' );
				$status    = $this->input->post( 'status' );

				$this->UserDAO->cadastrar( $nome, $inst_emp, $fone, $email, $pass, $tipo, $val_email, $status );
				
			}
	}
}	