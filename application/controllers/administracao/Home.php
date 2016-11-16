<?php
	if( !defined("BASEPATH")) exit('No direct script access allowed');

	class Home extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->library('Auth');
			//$this->Auth->CheckAuth($this->router->fetch_class(), $this->router->fetch_method());
		} 

		//Método chama a tela de login do organizador
		public function index(){
			$this->load->view("common/header");
            $this->load->view("inicio/login");
            $this->load->view("common/footer");
		}

		//Método recebe parametros email e senha e verifica no banco para conceder acesso ao organizador
		public function login(){
			$usuario = $this->input->post('email');
			$senha   = $this->input->post('senha');
			$this->db->where('user_email', $usuario);
			$this->db->where('user_pass', $senha);
			$this->db->where('user_status', 1);
			$usuario = $this->db->get('User')->result();
			if(count($usuario) === 1){
				$dados = array('usuario' => $usuario[0]->usuario, 'logado' => TRUE);
				$this->session->set_userdata($dados);
				redirect('organizador/');
			}
			else{
				redirect('administracao');
			}
		}

		//Método encerra a sessão e redireciona para home que chama a tela de login
		public function quit(){
			$this->session->session_destroy();
			redirect('administracao/Home');
		}
}		