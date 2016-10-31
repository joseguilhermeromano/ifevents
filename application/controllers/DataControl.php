<?php 
	if(! defined('BASEPATH')) exit('No direct script access allowed');

	class DataControl extends CI_Controller{


		/*Método construtor faz o carregamento de vários componentes
		necessários ao funcionamento do sistema*/

		public function __construct(){
			parent::__construct();	
			$this->load->model( 'SubmitModel' );
			$this->load->model('ContatoModel' );
			$this->load->model( 'UserModel' );
			$this->load->library( 'upload' );
		}

		public function index(){
			//
		}


		/*Método chama o função verifica na model submitCadastro*/

		public function submitCadastro(){
			$this->SubmitModel->upload_arquivo();
			$this->load->model('dao/SubmitDAO');

            $this->load->view("common/header_interno");
            $this->load->view("participante/novoartigo");
            $this->load->view("common/footer_interno");

		}


		//Metodo chama o método verifica para validação dos campos do formuĺário
		public function cadastraUser(){
			
			$this->UserModel->verifica();
		}


		//Método chama a viu sucesso para exibir mensagem de sucesso
		public function sucesso(){
			$this->load->view( 'common/header' );
			$this->load->view( 'mensagens/sucesso' );
			$this->load->view( 'common/footer' );

		}


		//Método chama a viu erros para exibir mensagem de erro
		public function erros(){
			$this->load->view( 'common/header' );
			$this->load->view( 'mensagens/erros' );
			$this->load->view( 'common/footer' );

		}


		/*public function ConsultaArtigo(){
			
			$dados = array(
				'result' => $this->SubmitDAO->Consulta()
			);
			//$this->SubmitDAO->Consulta();
		
			$this->load->view( 'common/header' );
			$this->load->view( 'inicio/testConsulta', $dados );
			$this->load->view( 'common/footer' );		
		}*/


		public function Download(){
			$this->SubmitDAO->DownArtigo();
			//$this->SubmitModel->BaixaArtigo();
			/*$data = array(
				'arq' => $this->SubmitModel->BaixaArtigo()			
			);
		$this->load->view( 'inicio/testConsulta', $data );*/
		}


		//Método chama model para verificar os campos do formulário de contato
		public function RegistraContato(){
            $this->ContatoModel->ContatoVerifying();
            
            $this->load->view("common/header_interno");
            $this->load->view("participante/contato");
            $this->load->view("common/footer_interno");

		}
}		