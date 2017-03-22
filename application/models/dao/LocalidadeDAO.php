<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class LocalidadeDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
        public function inserir($obj) {
            $this->db->insert('localidade', $obj);
            return $this->db->insert_id();
        }
        
        public function alterar($obj) {
            $this->db->where('loca_cd', $obj->loca_cd);
            return $this->db->update('localidade', $obj);
        }

        public function consultarTudo() {
            return null;
        }
        
        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($obj) {
            $this->db->where('loca_cd', $obj->ende_id);
            return $this->db->delete('localidade');
        }

                

}





