<?php

	class SubmitDAO extends CI_Model{

		function SubmitDAO(){
			parent::__construct('SubmitDAO');
			$this->load->library('upload');
		}


		//Função cria a tabela Submission no banco de dados
		
		/*
		function create_table_Submission(){				
			$sql = "CREATE TABLE IF NOT EXISTS Submission(
				       subm_cd int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
			          ,subm_ra int(7) NOT NULL
			          ,subm_titulo varchar(50) NOT NULL	
			          ,subm_autor varchar(50) NOT NULL		          			          		          
			          ,subm_instituicao varchar(50) NOT NULL
			          ,subm_resumo varchar(100) NOT NULL
			          ,subm_area varchar(50) NOT NULL			          
			          ,subm_orienta varchar(50) NOT NULL				          	
			          ,subm_apoio varchar(50)
			          ,subm_article mediumblob NOT NULL
			          
		    	    )";
			$this->db->query($sql);
		}*/


		//Função insere dados na tabela Submission do banco de dados

		public function Cadastrar(){
			/*
			 $dados = array(
            'subm_ra' => $this->input->post('subm_ra'),
            'subm_titulo' => $this->input->post('subm_titulo'),
            'subm_autor' => $this->input->post('subm_autor'),            
			'subm_instituicao' => $this->input->post('subm_instituicao'),			
			'subm_resumo' => $this->input->post('subm_resumo'),			
			'subm_area' => $this->input->post('subm_area'),
			'subm_orienta' => $this->input->post('subm_orienta'),
			'subm_apoio' => $this->input->post('subm_apoio'),						
			$subm_article = $_FILES['subm_article']['subm_article']
			
           );
			 	$this->upload->do_upload('Submission', $subm_article);			
				if($this->db->insert('Submission', $dados)){
					$this->session->set_flashdata('submited','Artigo enviado para avaliação');				
				}
				else{
					$this->session->set_flashdata('notsubmited','Artigo não pode ser enviado');
				}	
				redirect('InicioControl/formSubmit');
			
		}*/	   

	}
}