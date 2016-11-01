<?php
	if( !defined("BASEPATH")) exit('No direct script access allowed');

	class ComiteModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/ComiteDAO');
		}

		public function verifica(){
			$this->form_validation->set_rules(	'organizador', 'Organizador', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules(	'descricao', 'Descricao', 'trim|required|max_length[500]' );

			if ($this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('empty', 'Por favor preencha todos os campos');
				redirect('OrganizadorControl/comite');
			}
			else{
				$organizador = $this->input->post( 'organizador' );
				$descricao = $this->input->post( 'descricao' );

				$this->ComiteDAO->cadastra($organizador, $descricao );
			}
		}

	}