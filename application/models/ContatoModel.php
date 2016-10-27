<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class ContatoModel extends CI_Model{

	public function __construct(){
		parent::__construct();

		$this->load->model('dao/DataBaseDAO');
		$this->load->model('dao/ContatoDAO');
		$this->DataBaseDAO->create_table_Contato();
		//$this->DataBaseDAO->create_table_Contato();
	}
	
	//Método faz a verificação dos campos do formulário de contato
	public function ContatoVerifying(){
		$this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
		$this->form_validation->set_rules( 'email', 'E-mail', 'trim|required|max_length[80]' );
		$this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );		
		$this->form_validation->set_rules( 'mensagem', 'Mensagem', 'trim|required|max_length[200]' );

		if( $this->form_validation->run() == FALSE ){
			$this->session->set_flashdata('empty', 'Por Favor Preencha Todos Os Campos');
			redirect( 'ParticipanteControl/contato' );
				
		}
		else{

			$nome 		 = $this->input->post( 'nome' );		
			$email 		 = $this->input->post( 'email' );
			$assunto	 = $this->input->post( 'assunto' );
			$mensagem    = $this->input->post( 'mensagem' );
			
			$this->ContatoDAO->Registrar( $nome, $email, $assunto, $mensagem );
				
		}
	}		
}