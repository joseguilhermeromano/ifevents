<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class AvaliacaoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
        public function inserir($obj) {
            return $this->db->insert('avaliacao', $obj);
        }
        
        public function alterar($obj) {
            $this->db->where('aval_id', $obj->aval_id);
            return $this->db->update('avaliacao', $obj);
        }

        public function consultarTudo() {
            return null;
        }
        
        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($obj) {
            $this->db->where('aval_id', $obj->aval_id);
            return $this->db->delete('avaliacao');
        }

        public function consultarTrabalhosAindaNaoAtribuidos($conferencia){
            $this->db->select("
                 Artigo.arti_cd
                ,Artigo.arti_moda_cd
                , Artigo.arti_eite_cd
                , Artigo.arti_title
                , Submissao.subm_cd
                ,mote1.mote_nm as modalidade
                , mote2.mote_nm as eixo");
            $this->db->from("Submissao");
            $this->db->join('Artigo', 'Submissao.subm_arti_cd = Artigo.arti_cd','left');
            $this->db->join('Modalidade_Tematica mote1', 'Artigo.arti_moda_cd = mote1.mote_cd','left');
            $this->db->join('Modalidade_Tematica mote2', 'Artigo.arti_eite_cd = mote2.mote_cd','left');
            $this->db->where('mote1.mote_conf_cd', $conferencia);
            $this->db->where_not_in('Submissao.subm_cd', 'Avaliacao.aval_subm_cd');
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result_object();
            }else{
                return null;
            }
        }

                

}





