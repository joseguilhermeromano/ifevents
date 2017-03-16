<?php
	if( !defined("BASEPATH")) exit('No direct script access allowed');

	class ComiteModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/ComiteDAO');
		}

        public function valida(){
        	$this->form_validation->set_rules(	'organizador', 'Organizador', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules(	'descricao', 'Descricao', 'trim|required|max_length[500]' );
			return $this->form_validation->run();
        }

        public function setaValores(){
        	$this->comi_organizad = $this->input->post( 'organizador' );
			$this->comi_desc = $this->input->post( 'descricao' );
        }

	}