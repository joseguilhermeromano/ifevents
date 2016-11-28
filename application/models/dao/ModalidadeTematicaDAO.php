<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ModalidadeTematicaDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    return $this->db->insert('mote_id', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('mote_id', $obj->mote_id);
                    return $this->db->update('modalidade_tematica', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo($codigo){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('mote_id', $obj->mote_id);
                    return $this->db->delete('modalidade_tematica');
                }

                

}





