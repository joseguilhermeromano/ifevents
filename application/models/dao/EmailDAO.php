<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
    

	class EmailDAO extends CI_Model{

		public function __construct(){
			parent::__construct();

		}
                
        public function inserir($email) {
            $orig_db_debug = $this->db->db_debug;

            $this->db->db_debug = FALSE;
            $this->db->insert('Email', array('email_email' => $email));
            if($this->db->error()['code']==1062){
                throw new Exception('Já existe um usuário cadastrado com este mesmo endereço de E-mail!');
            }

            $this->db->db_debug = $orig_db_debug;
            return $this->db->insert_id();
        }
        
        public function alterar($email) {
            $orig_db_debug = $this->db->db_debug;
            $this->db->where('email_email', $email);
            $this->db->update('Email', array(
                     'email_email' => $email
                    ));  
            if($this->db->error()['code']==1062){
                throw new Exception('Já existe um usuário cadastrado com este mesmo endereço de E-mail!');
            }
            $this->db->db_debug = $orig_db_debug;
        }

        public function consultarTudo($email) {
            $this->db->select('*');
            $this->db->from('Email');
            $this->db->where('email_email', $email);
            $query = $this->db->get();
            return $query->result_object();
        }
        
        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($user_cd) {
            $this->db->where('email_user_cd', $user_cd);
            $this->db->delete('email');
        }

                

}





