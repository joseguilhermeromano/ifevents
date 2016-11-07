<?php
	if( !defined("BASEPATH")) exit('No direct script access allowed');

	class Home extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library('session');
		} 

		public function index(){
			$this->load->view("common/header");
            $this->load->view("inicio/login");
            $this->load->view("common/footer");
		}

		public function login(){
			$usuario = $this->input->post('usuario');
			$senha   = $this->input->post('senha');
			$this->db->where('user_email', $usuario);
			$this->db->where('user_pass', $senha);
			$this->db->where('user_status', 1);
			$usuario = $this->db->get('User')->result();
			if(count($usuario) === 1){
				$dados = array('usuario' => $usuario[0]->user_nm, 'logado' => TRUE);
				$this->session->set_userdata($dados);
				redirect('organizador');
			}
			else{
				redirect('administracao');
			}
		}
}		