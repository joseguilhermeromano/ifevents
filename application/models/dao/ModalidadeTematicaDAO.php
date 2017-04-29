<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ModalidadeTematicaDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();

		}
                
        public function inserir($obj) {
            return $this->db->insert('Modalidade_Tematica', $obj);
        }
        
        public function alterar($obj) {
            $this->db->where('mote_id', $obj->mote_id);
            return $this->db->update('Modalidade_Tematica', $obj);
        }

        public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='mote_nm', $ordenacao='asc') {
            $this->db->select("*");
            $this->db->from("Modalidade_Tematica");
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

        public function totalRegistros($conf_cd,$mote_tipo){
            $this->db->select('*');
            $this->db->from('Modalidade_Tematica');
            $this->db->where('mote_conf_cd', $conf_cd);
            $this->db->where('mote_tipo', $mote_tipo);
            $query = $this->db->get();
            return $query->num_rows();
        }
        
        public function consultarCodigo($codigo){
            $this->db->select('*');
            $this->db->from('Modalidade_Tematica');
            $this->db->where('mote_cd', $codigo);
            $query = $this->db->get();
            return $query->result_object()[0];
        }

        public function excluir($obj) {
            $this->db->where('mote_cd', $obj->mote_cd);
            return $this->db->delete('Modalidade_Tematica');
        }

                

}





