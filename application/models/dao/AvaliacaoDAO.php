<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class AvaliacaoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    return $this->db->insert('avaliacao', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('aval_id', $obj->aval_id);
                    return $this->db->update('avaliacao', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo(){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('aval_id', $obj->aval_id);
                    return $this->db->delete('avaliacao');
                }

                

}





