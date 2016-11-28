<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!
        
	class SubmitDAO extends CI_Model implements DAO{

		function SubmitDAO(){
			parent::__construct();
			$this->load->library('upload');
			
		}
		

                public function inserir($obj) {
                    return $this->db->insert('submissao', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('subm_id', $obj->subm_id);
                    return $this->db->update('submissao', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo($codigo){
                     $query=$this->db->get_where('submissao',array('subm_id' => $codigo));
                     return $query;
                }
                
                public function consultaPorArtigo($codigo){
                    $query=$this->db->get_where('submissao',array('subm_arti_cod' => $codigo));
                     return $query->result();
                }

                public function excluir($obj) {
                    $this->db->where('subm_id', $obj->subm_id);
                    return $this->db->delete('submissao');
                }

}    	




      
