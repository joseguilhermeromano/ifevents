<?php
	if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

	class UserDAO extends CI_Model{

		public function __construct(){
			parent::__construct('UserDAO');
		}

		public function cadastrar( $nome, $instituicao, $fone, $email, $pass, $tipo, $valida, $status ){
			
			$this->user_nm        = $nome;
			$this->user_ins_emp   = $instituicao;
			$this->user_fone      = $fone;			
			$this->user_email     = $email;
			$this->user_pass      = $pass;
		    $this->user_tipo      = $tipo;
			$this->user_val_email = $valida;
			$this->user_status    = $status;

			$confirm = $this->db->insert('User', $this);
				
			if($confirm){  
				$this->session->set_flashdata('success', 'Cadastro Realizado Com Sucesso');		
				redirect('cadastro');		
			}
			else{
				$this->session->set_flashdata('fail', 'O Cadastro Não Pode Ser Realizado');
				redirect( 'cadastro' );
			}
		}
	}