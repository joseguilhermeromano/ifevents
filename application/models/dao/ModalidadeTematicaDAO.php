<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ModalidadeTematicaDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    $confirma= $this->db->insert('mote_id', $obj);
                     if($confirma){
                         return true;
                     }
                         return false;
                }
                
                public function alterar($obj) {
                    $this->db->where('mote_id', $obj->mote_id);
                    $confirma=$this->db->update('modalidade_tematica', $obj);
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
                    $this->db->where('mote_id', $obj->mote_id);
                    $confirma= $this->db->delete('modalidade_tematica');
                    if($confirma){
                         return true;
                     }
                         return false;
                }

                

}





