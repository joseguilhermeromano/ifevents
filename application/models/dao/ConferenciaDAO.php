<?php
if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
include_once 'DAO.php';

class ConferenciaDAO extends CI_Model implements DAO{

    public function __construct(){
        parent::__construct('ConferenciaDAO');
        $this->load->model('ConferenciaModel', 'conferencia');
    }
    
    private function obtemValores($obj){
        return array('conf_nm' => $obj->getTitulo()
                ,'conf_abrev' => $obj->getAbreviacao()
                ,'conf_desc' => $obj->getDescricao());
    }

    public function inserir($obj) {
        return $this->db->insert('Conferencia', $this->obtemValores($obj));
    }

    public function alterar($obj) {
        $this->db->where('conf_cd', $obj->getCodigo());
        return $this->db->update('Conferencia', $this->obtemValores($obj));
    }

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null
        , $sort='conf_nm', $ordenacao='asc') {
        $this->db->select("*");
        $this->db->from("Conferencia");
        $this->db->order_by($sort, $ordenacao);
        if($parametros !== null){
            foreach ($parametros as $key => $value) {
                $this->db->or_where($key.' LIKE ','%'.$value.'%');
            }
        }
        if($limite){
            $this->db->limit($limite, $numPagina);
        }
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_object();
        }
            return null;
    }

    public function consultarPorNomeOuAbreviacao($nome){
        $this->db->select('*');
        $this->db->from('Conferencia');
        $this->db->where('conf_nm LIKE', '%'.$nome.'%');
        $this->db->or_where('conf_abrev LIKE', '%'.$nome.'%');
        $this->db->order_by("conf_nm", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function consultarCodigo($codigo){
        $this->db->select( 'conf_cd, conf_nm, conf_desc, conf_abrev' );
        $this->db->from( 'Conferencia' );
        $this->db->where( 'conf_cd', $codigo );
        $query       = $this->db->get();
        if($query->num_rows() > 0){
            $consulta       = $query->result_object()[0];
            
            $this->conferencia->setCodigo($consulta->conf_cd);
            $this->conferencia->setTitulo($consulta->conf_nm);
            $this->conferencia->setDescricao($consulta->conf_desc);
            $this->conferencia->setAbreviacao($consulta->conf_abrev);

            return $this->conferencia;
        }

        return null;
    }

    public function totalRegistros(){
        return $this->db->count_all("Conferencia");
    }
    
    public function excluir($obj) {
      $this->db->where('conf_cd', $obj);
      return $this->db->delete('Conferencia');
    }
}
