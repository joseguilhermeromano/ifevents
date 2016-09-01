<?php

	class DataControl extends CI_Controller{


		/*Método construtor faz o carregamento de vários componentes
		necessários ao funcionamento do sistema*/

		public function __construct(){
			parent::__construct();

			$this->load->library('upload');
			$this->load->model('SubmitModel');
		}

		public function index(){
			$this->SubmitModel->Create();
		}



		/*Método chama o função verifica na model submitCadastro*/

		public function submitCadastro(){
			$this->SubmitModel->Verifica();

			$this->load->view('common/header');
			$this->load->view('inicio/formSubmit');
			$this->load->view('common/footer');

		}


	}