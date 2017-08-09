<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ArtigoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                private function obtemValores($obj){
                    return array('arti_title' => $obj->getTitulo()
                    ,'arti_autores' => $obj->getAutores()
                    ,'arti_orienta' => $obj->getOrientador()
                    ,'arti_resumo' => $obj->getResumo()
                    ,'arti_status' => $obj->getStatus()
                    ,'arti_moda_cd' => $obj->getModalidade()
                    ,'arti_eite_cd' => $obj->getEixoTematico()
                    ,'arti_user_resp_cd' => $obj->getCodigoAutorResponsavel());
                }

                public function inserir($obj) {
                    $this->db->insert('Artigo', $this->obtemValores($obj));
                    return $this->db->insert_id();
                }

                public function alterar($obj) {
                    $this->db->where('arti_id', $obj->getCodigo());
                    return $this->db->update('artigo', $this->obtemValores($obj));
                }

                public function consultarTudo($parametros = null, $limite=null,
                        $numPagina=null, $sort='arti_title', $ordenacao='asc') {
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
                    if($limite){
                        $this->db->limit($limite, $numPagina);
                    }
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
                     $query       = $this->db->get();
                    if($query->num_rows() > 0){
                        $consulta       = $query->result_object()[0];

                        $this->artigo->setCodigo($consulta->arti_cd);
                        $this->artigo->setTitulo($consulta->arti_title);
                        $this->artigo->setOrientador($consulta->arti_orienta);
                        $this->artigo->setAutores($consulta->arti_autores);
                        $this->artigo->setResumo($consulta->arti_resumo);
                        $this->artigo->setStatus($consulta->arti_status);
                        $this->artigo->setEixoTematico($consulta->arti_eite_cd);
                        $this->artigo->setModalidade($consulta->arti_moda_cd);
                        $this->artigo->setCodigoAutorResponsavel($consulta->arti_user_resp_cd);

                        return $this->artigo;
                    }

                    return null;
                }

                public function excluir($obj) {
                    $this->db->where('arti_id', $obj->arti_id);
                    return $this->db->delete('artigo');
                }



}
