<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class DataControl extends CI_Controller{


		/*Método construtor faz o carregamento de vários componentes
		necessários ao funcionamento do sistema*/

		public function __construct(){
			parent::__construct();	
			$this->load->model( 'SubmitModel' );
		}

		public function index(){
			//
		}


		/*Método chama o função verifica na model submitCadastro*/

		public function submitCadastro(){
			$this->SubmitModel->upload_arquivo();
			$this->SubmitModel->Verifica();

			$this->load->view( 'common/header' );
			$this->load->view( 'inicio/formSubmit' );
			$this->load->view( 'common/footer' );

		}

		public function sucesso(){
			$this->load->view( 'common/header' );
			$this->load->view( 'mensagens/sucesso' );
			$this->load->view( 'common/footer' );

		}

		public function erros(){
			$this->load->view( 'common/header' );
			$this->load->view( 'mensagens/erros' );
			$this->load->view( 'common/footer' );

		}


	}