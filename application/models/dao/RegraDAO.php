<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class RegraDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    return $this->db->insert('User', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('regra_id', $obj->regra_id);
                    return $this->db->update('regra', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo(){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('regra_id', $obj->regra_id);
                    return $this->db->delete('regra');
                }

                

}

