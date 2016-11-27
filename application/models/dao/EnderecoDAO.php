<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class EnderecoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    return $this->db->insert('endereco', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('ende_id', $obj->ende_id);
                    return $this->db->update('endereco', $obj);
                }

                public function consultarTudo() {
                    return null;
                }
                
                public function consultarCodigo(){
                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('ende_id', $obj->ende_id);
                    return $this->db->delete('endereco');
                }

                

}





