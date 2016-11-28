<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!
        
	class ContatoDAO extends CI_Model implements DAO{

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

                public function inserir($obj) {
                    return  $this->db->insert('contato', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('cont_id', $obj->cont_id);
                    return $this->db->update('contato', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo($codigo){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('cont_id', $obj->cont_id);
                    return $this->db->delete('contato');
                }

}	