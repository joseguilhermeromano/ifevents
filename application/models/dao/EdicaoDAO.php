<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class EdicaoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
                public function inserir($obj) {
                    return $this->db->insert('edicao', $obj);
                }
                
                public function alterar($obj) {
                    $this->db->where('ende_id', $obj->ende_id);
                    return $this->db->update('edicao', $obj);
                }

                public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='conf_nm', $ordenacao='asc') {
                    $this->db->select("*");
                    $this->db->from("Edicao");
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
                    $this->db->where('ende_id', $obj->ende_id);
                    return $this->db->delete('edicao');
                }

                

}





