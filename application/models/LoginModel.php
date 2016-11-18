<?php
	if(! defined('BASEPATH')) exit('No direct script access allowed');

	class LoginModel extends CI_Model{

		public function __construct(){
			parent::__construct();
			

		}

		//Método faz login para acesso à área restrita
		public function Logar(){
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

	}