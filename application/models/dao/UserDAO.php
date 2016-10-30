<?php
	if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

	class UserDAO extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function cadastrar( $nome, $fone, $inst_emp, $email, $pass, $tipo, $val_email, $status ){

			$this->user_nm        = $nome;
			$this->user_fone      = $fone;
			$this->user_ins_emp   = $inst_emp;
			$this->user_email     = $email;
			$this->user_pass      = $pass;
		    $this->user_tipo      = $tipo;
			$this->user_val_email = $val_email;
			$this->user_status    = $status;

			$confirm = $this->db->insert('User', $this);
				
			if($confirm){  
				$this->session->set_flashdata('success', 'Postagem cadastrada Com Sucesso');		
				redirect('InicioControl/cadastro');		
			}
			else{
				$this->session->set_flashdata('fail', 'A postagem não pode ser registrada.');
				redirect( 'InicioControl/cadastro' );
			}		
		}
	}