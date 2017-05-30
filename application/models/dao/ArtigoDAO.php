<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ArtigoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}

                public function inserir($obj) {
                    $this->db->insert('Artigo', 
                    array(
                    'arti_title' => $obj->arti_title
                    ,'arti_autores' => $obj->arti_autores
                    ,'arti_orienta' => $obj->arti_orienta
                    ,'arti_resumo' => $obj->arti_resumo
                    ,'arti_status' => $obj->arti_status
                    ,'arti_moda_cd' => $obj->arti_moda_cd
                    ,'arti_eite_cd' => $obj->arti_eite_cd
                    ,'arti_user_resp_cd' => $obj->arti_user_resp_cd
                    ));

                    return $this->db->insert_id();
                }

                public function alterar($obj) {
                    $this->db->where('arti_id', $obj->arti_id);
                    return $this->db->update('artigo', $obj);
                }

                public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='arti_title', $ordenacao='asc') {
                    $this->db->select("*");
                    $this->db->from("Artigo");
                    // $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd','left');
                    // $this->db->join('Regra', 'Edicao.edic_regr_cd = Regra.regr_cd','left');
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

                public function totalRegistros(){
                    return $this->db->count_all("Artigo");
                }

                public function consultarCodigo($codigo){
                     $this->db->select("Artigo.*, Modalidade_Tematica.*");
                     $this->db->from("Artigo");
                     $this->db->join('Modalidade_Tematica', 'Artigo.arti_cd = Modalidade_Tematica.mote_cd','left');
                     $this->db->where('arti_cd', $codigo);
                     $query = $this->db->get();
                     return $query->result_object()[0];
                }

                public function excluir($obj) {
                    $this->db->where('arti_id', $obj->arti_id);
                    return $this->db->delete('artigo');
                }



}
