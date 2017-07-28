<?php
if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class ComiteDAO extends CI_Model implements DAO{

    public function __construct(){
        parent::__construct();
        $this->load->model('ComiteModel','comite');
    }

    public function inserir($obj) {
        return  $this->db->insert('comite', $obj);
    }

    public function alterar($obj) {
        $this->db->where('comi_id', $obj->arti_id);
        return $this->db->update('comite', $obj);
    }

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='comi_nm', $ordenacao='asc') {
        $this->db->select("*");
        $this->db->from("Comite");
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
        $this->db->select( 'comi_cd, comi_nm, comi_desc' );
        $this->db->from( 'Comite' );
        $this->db->where( 'comi_cd', $codigo );
        $query       = $this->db->get();
        if($query->num_rows() > 0){
            $query       = $query->result_object();
            $consulta    = $query[0];
            $this->comite->setCodigo($consulta->comi_cd);
            $this->comite->setNome($consulta->comi_nm);
            $this->comite->setDescricao($consulta->comi_desc);

            return $this->comite;
        }

            return null;
    }

    public function excluir($obj) {
        $this->db->where('comi_id', $obj->comi_id);
        return $this->db->delete('comite');
    }

}