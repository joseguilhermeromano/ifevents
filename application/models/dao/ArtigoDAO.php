<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ArtigoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    return $this->db->insert('artigo', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('arti_id', $obj->arti_id);
                    return $this->db->update('artigo', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo(){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('arti_id', $obj->arti_id);
                    return $this->db->delete('artigo');
                }

                

}





