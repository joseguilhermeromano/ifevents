<?php

	class SubmitModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/SubmitDAO');
			$this->load->model('dao/DataBaseDAO');
			$this->DataBaseDAO->create_table_avaliacao();
			$this->DataBaseDAO->create_table_avaliador();
			$this->DataBaseDAO->create_table_participante();			
			$this->DataBaseDAO->create_table_Submissao();
			$this->DataBaseDAO->create_table_users();

		}

	
	
		//Função faz a validação dos campos e chama a função cadastrar na model submitDAO
		public function Verifica(){
			/*
			$this->form_validation->set_rules('subm_ra', 'RA', 'trim|required|max_length[7]');
			$this->form_validation->set_rules('subm_titulo','Título', 'trim|required|max_length[50]|ucwords');		
			$this->form_validation->set_rules('subm_autor', 'Autor(es)', 'trim|required|max_length[50]|ucwords');
			$this->form_validation->set_rules('subm_instituicao', 'Instituição', 'trim|required|max_length[50]|ucwords');
			$this->form_validation->set_rules('subm_resumo', 'Resumo', 'trim|required|max_length[100]');
			$this->form_validation->set_rules('subm_area', 'Área', 'trim|required|max_length[50]|ucwords');			
			$this->form_validation->set_rules('subm_orienta', 'Orientedor', 'trim|required|max_length[50]|ucwords');
			$this->form_validation->set_rules('subm_apoio', 'Patrocínio', 'trim|max_length[50]|ucwords');			
			//$this->form_validation->set_rules('subm_article', 'Artigo', 'trim|required');
			*/

			if($this->form_validation->run() == TRUE){
				$this->SubmitDAO->Cadastrar();					 		
			
		}
	}

}