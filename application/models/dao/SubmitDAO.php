<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class SubmitDAO extends CI_Model{

		function SubmitDAO(){
			parent::__construct('SubmitDAO');
			
		}


		//Função insere dados na tabela Submissao do banco de dados
		public function Cadastrar( $ra, $titulo, $autor, $instituicao, $resumo, $area, $orientador, $apoio, $artigo ){
						            
            $this->subm_ra     		= $ra;
            $this->subm_titulo 		= $titulo;
            $this->subm_autor  		= $autor;            
			$this->subm_instituicao = $instituicao;			
			$this->subm_resumo      = $resumo;			
			$this->subm_area        = $area;
			$this->subm_orientador  = $orientador;
			$this->subm_apoio       = $apoio;						
			$this->subm_artigo      = $artigo;
			
           
			 //$this->subm_article = $arquivo;
			 	//$this->upload->do_upload('Submission', $subm_article);			
			 	$confirm = $this->db->insert('submissao', $this);
				if($confirm){
					$this->session->set_flashdata('submited','Artigo enviado para avaliação');		
					redirect('InicioControl');		
				}
				else{
					$this->session->set_flashdata('notes_unread(database_name, user_name)bmited','Artigo não pode ser enviado');
				}	
				redirect('InicioControl/formSubmit');
			
		} 

}
