<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');


	class TelefoneDAO extends CI_Model{

		public function __construct(){
			parent::__construct();

		}

        public function inserir($obj) {
            //Verifica se telefone já está cadastrado, caso afirmativo ele retorna o codigo do telefone
            $this->db->select('*');
            $this->db->from('Telefone');
            $this->db->where('tele_fone', $obj->tele_fone);
            $query = $this->db->get();
            if(isset($query->result_object()[0])){
                return $query->result_object()[0]->tele_cd;
            }
            //Cadastra um novo telefone
            $this->db->insert('Telefone', $obj);
            return $this->db->insert_id();
        }

        public function alterar($obj) {
            $this->db->where('tele_cd', $obj->tele_cd);
            $this->db->update('Telefone', $obj);
        }

        public function verificaTelefoneExiste($telefone){
            $this->db->select('*');
            $this->db->from('Telefone');
            $this->db->where('tele_fone', $telefone);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_object()[0]->tele_cd;
            }else{
                return null;
            }
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
