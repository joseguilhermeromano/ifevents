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
                    $this->db->select('*');
                    $this->db->from('Submissao');
                    $this->db->where('subm_cd', $codigo);
                    $query = $this->db->get();
                     return $query->result_object()[0];
                }
                
                public function consultarPorArtigo($codigo){
                    $query=$this->db->get_where('submissao',array('subm_arti_cd' => $codigo));
                     return $query->result_object();
                }

                public function totalRegistros($artigo_cd){
                     $query=$this->db->get_where('submissao',array('subm_arti_cd' => $artigo_cd));
                     return $query->free_result();
                }

                public function excluir($obj) {
                    $this->db->where('subm_id', $obj->subm_id);
                    return $this->db->delete('submissao');
                }

}    	




      
