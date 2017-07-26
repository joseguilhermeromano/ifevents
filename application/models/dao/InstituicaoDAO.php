<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

    include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class InstituicaoDAO extends CI_Model implements DAO{

    public function __construct(){
            parent::__construct('InstituicaoDAO');
            $this->load->model('InstituicaoModel', 'instituicao');
    }

    public function inserir($obj) {
        return $this->db->insert('Instituicao', $obj);
    }

    public function alterar($obj) {
        $this->db->where('inst_cd', $obj->inst_cd);
        return $this->db->update('Instituicao', $obj);
    }


    public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='inst_nm', $ordenacao='asc') {
        $this->db->select("inst_cd, inst_nm, inst_desc");
        $this->db->from("Instituicao");
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
        $this->db->where('inst_cd',$codigo);
        $query = $this->db->get('Instituicao');
        if($query->num_rows()>0){
            $consulta = $query->result_object()[0];
            $this->instituicao->setCodigo($consulta->inst_cd);
            $this->instituicao->setNome($consulta->inst_nm);
            $this->instituicao->setAbreviacao($consulta->inst_abrev);
            $this->instituicao->setDescricao($consulta->inst_desc);
            return $this->instituicao;
        }
        return null;
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
        $this->db->where('inst_cd', $obj);
        return $this->db->delete('Instituicao');
    }

}
