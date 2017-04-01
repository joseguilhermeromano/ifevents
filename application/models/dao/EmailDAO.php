<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class EmailDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
        public function inserir($obj) {
            $orig_db_debug = $this->db->db_debug;

            $this->db->db_debug = FALSE;
            $this->db->insert('email', $obj);
            if($this->db->error()['code']==1062){
                throw new Exception('Já existe um usuário cadastrado com este mesmo endereço de E-mail!');
            }

            $this->db->db_debug = $orig_db_debug;
            return $this->db->insert_id();
        }
        
        public function alterar($obj) {
            $this->db->where('email_cd', $obj->email_cd);
            $this->db->update('Email', array(
                     'email_email' => $obj->email_email
                    ));  
        }

        public function consultarTudo() {
            return null;
        }
        
        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($user_cd) {
            $this->db->where('email_user_cd', $user_cd);
            $this->db->delete('email');
        }

                

}





