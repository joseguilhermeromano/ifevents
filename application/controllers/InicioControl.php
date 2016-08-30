<?php

	class InicioControl extends CI_Controller{

		public function __construct(){
			parent::__construct();

			$this->load->helper('url');
			$this->load->model('SubmitModel');
			
		}


		public function index(){

			$this->load->view("common/header");
			$this->load->view("inicio/index");
			$this->load->view("common/footer");
		}

		public function programacao(){
			echo 'programação do evento';
		}

		public function gerenciar(){
			echo 'Área de gerenciamento';
		}

		public function avaliador(){
			echo 'Área do avaliador';
		}

		public function participante(){
			echo 'Área do participante';
		}

		public function cadastro(){
			$this->load->view('common/header');
			$this->load->view('inicio/cadastro');
			$this->load->view('common/footer');
		}

		public function submissao(){
			$this->load->view('common/header');
			$this->load->view('inicio/submissao');
			$this->load->view('common/footer');
		}


		public function formSubmit(){
			$this->load->view('common/header');
			$this->load->view('inicio/formSubmit');
			$this->load->view('common/footer');
		}

		public function upload(){
			$this->load->view('common/header');
			$this->load->view('inicio/testUpload');
			$this->load->view('common/footer');
		}		
	}