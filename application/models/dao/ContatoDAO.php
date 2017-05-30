<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ContatoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct('ContatoDAO');

		}

		//Método Registra mensagem de contatos na tabela Contatos do banco de dados
		/*public function Registrar( $nome, $email, $assunto, $mensagem ){
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
		}*/

                public function inserir($obj) {
                    return  $this->db->insert('Contato', $obj);
                }

                public function alterar($obj) {
                    $this->db->where('cont_id', $obj->cont_id);
                    return $this->db->update('contato', $obj);
                }

                public function consultarTudo() {
                    $query=$this->db->select('cont_cd, cont_nm, cont_assunto, cont_email, cont_msg, cont_user_cd')
            								 ->from('Contato')
        									 ->get();
        			if($query->num_rows() > 0){
                		return $query->result_object();
            		 }
            		else{
                		return FALSE;
            		}
                }

                public function consultarCodigo($codigo){                    
                    $this->db->where('cont_cd', $codigo);
                    $query = $this->db->get('Contato');
                    if($query->num_rows() > 0){
                        return $query->result_object()[0];
                    }
                    else{
                        return FALSE;
                    }
                }

                public function excluir($obj) {
                    $this->db->where('cont_cd', $obj);
                    return $this->db->delete('Contato');
                }

                public function insertResposta($codigo){
                    return  $this->db->insert('Resposta', $codigo);
                }

}
