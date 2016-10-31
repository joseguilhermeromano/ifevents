<?php
	if( !defined("BASEPATH")) exit('No direct script access allowed');

	class OrganizaModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/OrganizaDAO');
		}

		public function verifica(){
			$this->form_validation->set_rules( 'titulo', 'Título', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules( 'descricao', 'Descrião', 'trim|required|max_length[500]' );

			if( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('empty', 'Por Favor Preencha Todos Os Campos');
				redirect( 'OrganizadorControl/conferencias' );
				
			}
			else{

				$titulo    = $this->input->post( 'titulo' );		
				$descricao = $this->input->post( 'descricao' );
							
				$this->OrganizaDAO->Cadastrar( $titulo, $descricao );
				
			}
		}
	}