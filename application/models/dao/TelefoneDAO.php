<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');


	class TelefoneDAO extends CI_Model{

		public function __construct(){
			parent::__construct();

		}

        public function inserir($telefone) {
            //Verifica se telefone já está cadastrado, caso afirmativo ele retorna o codigo do telefone
            $this->db->select('*');
            $this->db->from('Telefone');
            $this->db->where('tele_fone', $telefone);
            $query = $this->db->get();
            if(isset($query->result_object()[0])){
                return $query->result_object()[0]->tele_cd;
            }


            //Cadastra um novo telefone
            $this->db->insert('Telefone', array('tele_fone' => $telefone));
            return $this->db->insert_id();
        }

        public function alterar($telefoneAntigo, $telefoneNovo) {

            $this->db->select('edic_tele_cd');
            $this->db->from('Edicao');
            $this->db->join('Telefone', 'Edicao.edic_tele_cd = Telefone.tele_cd', 'left');
            $this->db->where('tele_fone',$telefoneAntigo);
            $query_um = $this->db->get();
            $query_um = count($query_um->result_object());

            $this->db->select('user_tele_cd');
            $this->db->from('User');
            $this->db->join('Telefone', 'User.user_tele_cd = Telefone.tele_cd', 'left');
            $this->db->where('tele_fone', $telefoneAntigo);
            $query_dois = $this->db->get();
            $query_dois =count($query_dois->result_object());


            if($query_um > 1 || $query_dois > 1){
                return $this->inserir($telefoneNovo);
            }

            //Verifica se telefone já está cadastrado, caso afirmativo ele retorna o codigo do telefone
            $this->db->select('*');
            $this->db->from('Telefone');
            $this->db->where('tele_fone', $telefoneNovo);
            $query = $this->db->get();
            if(isset($query->result_object()[0])){
                return $query->result_object()[0]->tele_cd;
            }

            $this->db->where('tele_fone', $telefoneAntigo);
            $query = $this->db->get('Telefone');
            $updated_id = $query->result_object()[0]->tele_cd;

            $this->db->where('tele_fone', $telefoneAntigo);
            $this->db->update('Telefone', array('tele_fone' => $telefoneNovo) );

            return $updated_id;
        }

        public function getCodigoTelefone($telefone){
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
