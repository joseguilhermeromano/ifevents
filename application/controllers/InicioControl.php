<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
	require_once 'PrincipalControl.php';

	class InicioControl extends PrincipalControl{

		/*Método construtor faz o carregamento de vários componentes
		necessários ao funcionamento do sistema*/

		public function __construct(){
			parent::__construct();
			// $this->load->model('dao/DataBaseDAO');
//			$this->DataBaseDAO->create_table_ci_session();
			// $this->load->model('SubmitModel');
			// $this->load->model('UserModel');
			// $this->model('Autentica');
		}
		//Método chama a view principal do sistema (Home)
		public function index(){
			
			$this->chamaView("index", "inicio",array("title"=>"IFEvents - Página Inicial - Seja bem vindo!"), 0);
		}

		public function sobre(){
			
			$this->chamaView("sobre", "inicio",
            	array("title"=>"IFEvents - Sobre"), 0);
		}

		public function evento(){

			$this->chamaView("evento", "inicio",
            	array("title"=>"IFEvents - Sobre o Evento"), 0);
		}


		public function programacao(){

			$this->chamaView("programacao", "inicio",array("title"=>"IFEvents - Programação do Evento"), 0);
		}

		/*Método chama a view que contém links para documentos
		com as regras para submissão de artigos*/

		public function submissao(){
			
			$this->chamaView("submissao", "inicio",
            	array("title"=>"IFEvents - Submissão"), 0);
		}

		public function resultadosAnais(){

			$this->chamaView("resultados_anais", "inicio",
            	array("title"=>"IFEvents - Resultados & Anais"), 0);
		}

		// //Método chama a view que contém formulário de cadastro para participantes
		// public function cadastraParticipante(){

  //           $this->chamaView("cadastro_participante", "inicio",
  //           	array("title"=>"IFEvents - Cadastro de Participantes"), 0);
		// }

		// public function cadastraRevisor(){

		// 	$this->chamaView("cadastro_revisor", "inicio",
  //           	array("title"=>"IFEvents - Contato"), 0);
		// }


        //Método que chama a view do login
        public function login(){

            $this->chamaView("login", "inicio",
            	array("title"=>"IFEvents - Login"), 0);
        }

		public function contato(){

			$this->chamaView("contato", "inicio",
            	array("title"=>"IFEvents - Contato"), 0);
		}

		public function recuperaSenha(){

            $this->chamaView("recupera_senha", "inicio",
            	array("title"=>"IFEvents - Recuperação de Senha"), 0);
		}

		public function noPermission(){

			$this->chamaView("noPermission", "inicio",
            	array("title"=>"IFEvents - Erro de Permissão"), 0);
		}

}