<?php
    if ( !defined( 'BASEPATH')) exit( 'No direct script access allowed');

    require_once 'DAO.php';

    class TipoAtividadeDAO extends CI_Model implements DAO{

        public function __construct(){
            parent::__construct();

        }

        public function inserir($obj) {
            return $this->db->insert( 'Tipo_atividade', $obj );
        }

        public function ultimoId(){
            //return $this->db->insert_id();
        }

        public function alterar($obj) {
            $this->db->where('tiat_cd', $obj->tiat_cd);
            $this->db->set('tiat_nm', $obj->tiat_nm);
            $this->db->set('tiat_desc', $obj->tiat_desc);
            return $this->db->update('Tipo_atividade', $obj);
        }

        public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='tiat_nm', $ordenacao='asc') {
            $this->db->select("tiat_cd, tiat_nm, tiat_desc");
            $this->db->from("Tipo_atividade");
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
            $this->db->where('tiat_cd', $codigo);
            $query = $this->db->get('Tipo_atividade');
            if($query->num_rows() > 0){
                return $query->result_object();
            }
            else{
                return false;
            }
        }

        public function excluir($obj) {
            $this->db->where('tiat_cd', $obj);
            return $this->db->delete('Tipo_atividade');
        }



    }
