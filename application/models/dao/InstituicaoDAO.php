<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

    include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class InstituicaoDAO extends CI_Model implements DAO{

    public function __construct(){
            parent::__construct('InstituicaoDAO');
    }

    public function inserir($obj) {
        return $this->db->insert('user', $obj);
    }
    
    public function alterar($obj) {
        $this->db->where('user_id', $obj->user_id);
        return $this->db->update('user', $obj);
    }

    public function consultarTudo() {
        return null;
    }

     public function consultarCodigo($codigo){
        $this->db->where('inst_cd',$codigo);
        $query = $this->db->get('instituicao');
        return $query->result_object();
     }
    
    public function consultarPorNomeOuAbreviacao($nome){
        // $this->db->like('inst_nm', $nome);
        // $this->db->like('inst_abrev', $nome);
        $this->db->select('*');
        $this->db->from('Instituicao');
        $this->db->where('inst_nm LIKE', '%'.$nome.'%');
        $this->db->or_where('inst_abrev LIKE', '%'.$nome.'%');
        $this->db->order_by("inst_nm", "asc");
		$query = $this->db->get();
		return $query->result_array();
    }

    public function excluir($obj) {
        $this->db->where('user_id', $obj->user_id);
        return $this->db->delete('user');
    }

}