<?php

	class InicioControl extends CI_Controller{

		public function __construct(){
			parent::__construct();

			$this->load->helper('url');
		}


		public function index(){
			$this->load->view("inicio/index");
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

		public function submissao(){
			echo 'Área de submissão';
		}

		public function cadastro(){
			$this->load->view('inicio/cadastro');
		}

		public function submitCadastro(){
			echo '<h1>Calma ainda não está pronto</h1>';
		}

		
	}