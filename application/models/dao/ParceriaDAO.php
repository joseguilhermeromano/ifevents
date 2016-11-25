<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ParceriaDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    $confirma= $this->db->insert('parceria', $obj);
                     if($confirma){
                         return true;
                     }
                         return false;
                }
                
                public function alterar($obj) {
                    $this->db->where('parc_id', $obj->parc_id);
                    $confirma=$this->db->update('parcela', $obj);
                    if($confirma){
                         return true;
                     }
                         return false;
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo(){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('parc_id', $obj->parc_id);
                    $confirma= $this->db->delete('parcela');
                    if($confirma){
                         return true;
                     }
                         return false;
                }

                

}



