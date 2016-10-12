<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class ContatoDAO extends CI_Model{

		public function __construct(){
			parent::__construct('ContatoDAO');

		}

		//Método Registra mensagem de contatos na tabela Contatos do banco de dados
		public function Registrar( $nome, $email, $assunto, $mensagem ){            						            
            $this->cont_nm      = $nome;
            $this->cont_email 	= $email;
            $this->cont_assunto	= $assunto;            
			$this->cont_mens    = $mensagem;			
			       
			$confirm = $this->db->insert('Contato', $this);
				
			if($confirm){  
				$this->session->set_flashdata('success', 'Messagem cadastrada Com Sucesso');		
				redirect('participanteControl/contato');		
			}
			else{
				$this->session->set_flashdata('fail', 'A mensagem não pode ser registrada.');
				redirect( 'participanteControl/contato' );
			}		
		} 
	}	