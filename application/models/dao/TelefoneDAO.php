<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class TelefoneDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
        public function inserir($obj) {
            return $this->db->insert('telefone', $obj);
        }
        
        public function alterar($obj) {

        }

        public function consultarTudo() {
            return null;
        }
        
        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($user_cd) {
            $this->db->where('tele_user_cd', $user_cd);
            $this->db->delete('telefone');
        }

                

}





