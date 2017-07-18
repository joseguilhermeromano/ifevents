<?php
		if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
  		include_once 'DAO.php';
		class ConferenciaDAO extends CI_Model implements DAO{

			public function __construct(){
				parent::__construct('ConferenciaDAO');
			}

			public function inserir($obj) {
      	return $this->db->insert('Conferencia', $obj);
      }

      public function alterar($obj) {
      	$this->db->where('conf_cd', $obj->conf_cd);
				$this->db->set('conf_nm', $obj->conf_nm);
				$this->db->set('conf_abrev', $obj->conf_abrev);
				$this->db->set('conf_desc', $obj->conf_desc);
        return $this->db->update('Conferencia', $obj);
      }

      public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='conf_nm', $ordenacao='asc') {
      	$this->db->select("*");
        $this->db->from("Conferencia");
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
				$this->db->select( 'conf_cd, conf_nm, conf_abrev, conf_desc' );
				$this->db->from( 'Conferencia' );
				$this->db->where( 'conf_cd', $codigo );
				$query = $this->db->get();
				return $query->result_object()[0];
      }

      public function excluir($obj) {
      	$this->db->where('conf_cd', $obj);
        return $this->db->delete('Conferencia');
      }
		}
