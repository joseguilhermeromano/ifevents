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

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null,
        $sort='mote_nm', $ordenacao='asc') {
        $this->db->select("*");
        $this->db->from("Modalidade_Tematica");
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

    public function totalRegistros($codigoEdicao,$mote_tipo){
        $this->db->select('*');
        $this->db->from('Modalidade_Tematica');
        $this->db->where('mote_edic_cd', $codigoEdicao);
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

    public function consultarModaTemaRevisor($codigoEdicao, $codigoRevisor){
        $this->db->select("Modalidade_Tematica.*");
        $this->db->from("Mote_Revisor");
        $this->db->join('Modalidade_Tematica', 'Mote_Revisor.more_mote_cd = Modalidade_Tematica.mote_cd ','left');
        $this->db->where('Mote_Revisor.more_user_cd', $codigoRevisor);
        $this->db->where('Modalidade_Tematica.mote_edic_cd', $codigoEdicao);
        $this->db->order_by('Modalidade_Tematica.mote_nm', 'asc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_object();
        }
        return null;
    }

    public function consultarRevisorPorModalidadeTematica($modalidade, $eixo){
        $this->db->select("user_cd, user_nm, group_concat(more_mote_cd) as modalidades_eixos");
        $this->db->from("mote_revisor");
        $this->db->join('User', 'Mote_Revisor.more_user_cd = User.user_cd', 'inner');
        $this->db->group_by("more_user_cd");
        $query = $this->db->get();
        if($query->num_rows()>0){
            $revisores = array();
            $consulta =  $query->result_object();
            foreach($consulta as $k => $rev){
                $modaEixos = $rev->modalidades_eixos;
                $array = explode(",", $modaEixos);
                $temModalidade = in_array($modalidade, $array);
                $temEixo = in_array($eixo, $array);
                if ($temModalidade === true && $temEixo === true){
                    array_push($revisores, $rev);
                }
            }
            return $revisores;
        }else{
            return null;
        }
    }

    public function insereModaTemaRevisor($modalidades, $eixos, $revisor){
        foreach ($modalidades as $key => $modalidade) {
            $data = array('more_mote_cd' => $modalidade
            , 'more_user_cd' => $revisor);
            $this->db->insert('mote_revisor', $data);
        }

        foreach ($eixos as $key => $eixo) {
            $data = array('more_mote_cd' => $eixo
            , 'more_user_cd' => $revisor);
            $this->db->insert('mote_revisor',$data);
        }

        if($this->db->affected_rows()){
            return true;
        }
        return false;
    }

    public function excluir($obj) {
        $this->db->where('mote_cd', $obj->mote_cd);
        return $this->db->delete('Modalidade_Tematica');
    }

                

}





