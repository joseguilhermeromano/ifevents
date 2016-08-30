<?php

	class DataControl extends CI_Controller{

		public function __construct(){
			parent::__construct();

			$this->load->library('upload');
			$this->load->model('SubmitModel');
		}

		public function submitCadastro(){
			$this->SubmitModel->verifica();

			$this->load->view('common/header');
			$this->load->view('inicio/formSubmit');
			$this->load->view('common/footer');

		}


	}