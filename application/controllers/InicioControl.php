<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class InicioControl extends CI_Controller{

		/*Método construtor faz o carregamento de vários componentes
		necessários ao funcionamento do sistema*/

		public function __construct(){
			parent::__construct();

			$this->load->helper('url');
			$this->load->model('SubmitModel');
			
		}

		//Método chama a view principal do sistema (Home)
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

		//Método chama a view que contém formulário de cadastro para participantes e avaliadores
		public function cadastro(){
			$this->load->view('common/header');
			$this->load->view('inicio/cadastro');
			$this->load->view('common/footer');
		}
                
        //Método que chama a view do login
        public function login(){
            $this->load->view('common/header');
            $this->load->view('inicio/login');
            $this->load->view('common/footer');
        }
                
        //teste 
        public function teste(){
            $this->load->view('common/header_interno');
            $this->load->view('participante/index');
            $this->load->view('common/footer_interno');
        }


		/*Método chama a view que contém links para documentos
		com as regras para submissão de artigos*/

		public function submissao(){
			$this->load->view('common/header');
			$this->load->view('inicio/submissao');
			$this->load->view('common/footer');
		}


		//Método chama a view que contém formulário para upload do artigo
		public function formSubmit(){
			$this->load->view('common/header');
			$this->load->view('inicio/formSubmit');
			$this->load->view('common/footer');
		}

		/*public function upload(){
			$this->load->view('common/header');
			$this->load->view('inicio/testUpload');
			$this->load->view('common/footer');
		}*/		

		public function error_404(){
			$this->load->view('errors/html/error_404');
		}
	}