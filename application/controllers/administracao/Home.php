<?php
	if( !defined("BASEPATH")) exit('No direct script access allowed');

	class Home extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->model('LoginModel');			
			$this->load->model('acesso/Autentica');
			
		} 


		//Método chama a tela de login do organizador
		public function index(){
			$this->load->view("common/header");
            $this->load->view("inicio/login");
            $this->load->view("common/footer");
		}


		//Método recebe parametros email e senha e verifica no banco para conceder acesso ao organizador
		public function login(){			
			if($this->Autentica->Checa($this->router->fetch_class(), $this->router->fetch_method())){
				$this->LoginModel->Logar();
			}
			//else{
			//	redirect('cadastro');
			//}
		}


		//Método encerra a sessão e redireciona para home que chama a tela de login
		public function quit(){
			$this->session->session_destroy();
			redirect('administracao/Home');
		}
}		