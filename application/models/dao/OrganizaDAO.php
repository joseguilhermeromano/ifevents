<?php
	if( !defined("BASEPATH")) exit('No direct srcipt access allowed');

	class OrganizaDAO extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		public function Cadastrar( $titulo, $descricao ){

			$this->conf_nm   = $titulo;
			$this->conf_desc = $descricao;

			$confirm = $this->db->insert('Conferencia', $this);
				
			if($confirm){  
				$this->session->set_flashdata('success', 'Conferencia Cadastrada Com Sucesso');		
				redirect('OrganizadorControl/conferencias');		
			}
			else{
				$this->session->set_flashdata('empty', 'Os dados não puderam ser Inseridos.');
				redirect( 'OrganizadorControl/conferencias' );
			}	

		}
	}