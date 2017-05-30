<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ParceriaDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    return  $this->db->insert('parceria', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('parc_id', $obj->parc_id);
                    return $this->db->update('parcela', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo($codigo){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('parc_id', $obj->parc_id);
                    return  $this->db->delete('parcela');
                }

                

}



