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

        public function consultarTudo($parametros = null, $limite=null, $numPagina=null,
                $sort='arti_title', $ordenacao='asc') {
            $this->db->select("Artigo.arti_title, Artigo.arti_cd, Edicao.edic_num, Conferencia.conf_abrev,
            mote1.mote_nm as modalidade, mote2.mote_nm as eixo, aval_status, Submissao.subm_cd");
            $this->db->from("Avaliacao");
            $this->db->join('Submissao', 'Avaliacao.aval_subm_cd = Submissao.subm_cd', 'left');
            $this->db->join('Artigo', 'Submissao.subm_arti_cd = Artigo.arti_cd', 'left');
            $this->db->join('Modalidade_Tematica mote1', 'Artigo.arti_moda_cd = mote1.mote_cd','left');
            $this->db->join('Modalidade_Tematica mote2', 'Artigo.arti_eite_cd = mote2.mote_cd','left');
            $this->db->join('Edicao', 'mote1.mote_edic_cd = Edicao.edic_cd','left');
            $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd','left');
            $this->db->join('Regra', 'Edicao.edic_regr_cd = Regra.regr_cd','left');
            $this->db->where('Regra.regr_revi_abert <=', date('y-m-d'));
            $this->db->where('Regra.regr_revi_encerr >=', date('y-m-d'));
            $this->db->order_by($sort, $ordenacao);
            if($parametros !== null){
                foreach ($parametros as $key => $value) {
                    $this->db->where($key.' LIKE ','%'.$value.'%');
                }
            }
            if($limite)
                $this->db->limit($limite, $numPagina);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result_object();
            }else{
                return null;
            }
        }

        public function consultarCodigo($codigo){
            return null;
        }

        public function excluir($obj) {
            $this->db->where('aval_id', $obj->aval_id);
            return $this->db->delete('avaliacao');
        }

        public function consultarTrabalhosAindaNaoAtribuidos($parametros){
            $this->db->select("Artigo.arti_cd, Artigo.arti_moda_cd, Artigo.arti_eite_cd, Artigo.arti_title,
							   Submissao.subm_cd, mote1.mote_nm as modalidade, mote2.mote_nm as eixo");
            $this->db->from("Submissao");
            $this->db->join('Artigo', 'Submissao.subm_arti_cd = Artigo.arti_cd','left');
            $this->db->join('Modalidade_Tematica mote1', 'Artigo.arti_moda_cd = mote1.mote_cd','left');
            $this->db->join('Modalidade_Tematica mote2', 'Artigo.arti_eite_cd = mote2.mote_cd','left');
            $this->db->where('subm_cd NOT IN (SELECT aval_subm_cd FROM Avaliacao)');
            if($parametros !== null){
                foreach ($parametros as $key => $value) {
                    $this->db->where($key.' LIKE ','%'.$value.'%');
                }
            }
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result_object();
            }else{
                return null;
            }
        }

        public function atribuirRevisor($revisores, $submissao){
            foreach ($revisores as $key => $value) {
                $this->db->insert("avaliacao",array('aval_user_cd' => $value, 'aval_subm_cd' => $submissao));
            }
            if($this->db->affected_rows()){
                return 0;
            }else{
                return 1;
            }
        }
}
