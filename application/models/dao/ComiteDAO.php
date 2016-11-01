<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

	class ComiteDAO extends CI_Model{

		public function __construct(){
			parent::__construct();

		}

		public function cadastra( $organizador, $descricao ){
			$this->comi_organizad = $organizador;
			$this->comi_desc      = $descricao;

			$confirma = $this->db->insert( 'Comite', $this );

			if ($confirma){
				$this->session->set_flashdata('success', 'Comitê cadastrado com sucesso' );
				redirect('OrganizadorControl/comite');
			}
			else{
				$this->session->set_flashdata('fail', 'Comitê não pode ser cadastrado' );
				redirect('OrganizadorControl/comite');
			}
		}
	}