<?php
if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
include_once 'DAO.php';// Chamar sempre a interface por esta forma!
class InscricaoDAO extends CI_Model implements DAO{

    public function __construct(){
        parent::__construct();
        $this->load->Model( 'InscricaoModel', 'inscricao' );
        $this->load->Model( 'dao/AtividadeDAO' );
        $this->load->Model( 'dao/UsuarioDAO' );
        
    }

    public function inserir($obj) {
        return $this->db->insert('Inscricao', $this->obtemValores($obj));
    }

    public function ultimoId(){
        return $this->db->insert_id();
    }
    
    private function obtemValores($obj){
        return array('insc_cd' => $obj->getCodigo()
                ,'insc_ativ_cd' => $obj->getAtividade()->getCodigo()
                ,'insc_user_cd' => $obj->getUsuario()->getCodigo()
                ,'insc_status' => $obj->getStatus());
    }

    public function alterar($obj) {
        $this->db->where('insc_cd', $obj->getCodigo());
        return $this->db->update('Inscricao', $this->obtemValores($obj));
    }

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null,
            $sort=null, $ordenacao='asc') {
        $this->db->select("insc_cd, insc_ativ_cd, insc_user_cd, ativ_nm, ativ_dt, user_nm,"
                . " edic_num, conf_abrev, insc_status");
        $this->db->from("Inscricao");
        $this->db->join('User', 'Inscricao.insc_user_cd = User.user_cd', 'left');
        $this->db->join('Atividade', 'Inscricao.insc_ativ_cd = Atividade.ativ_cd', 'left');
        $this->db->join('Edicao', 'Atividade.ativ_edic_cd = Edicao.edic_cd', 'left');
        $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd', 'left');
        $this->db->order_by($sort, $ordenacao);
        if($parametros !== null){
            $this->db->where('edic_cd', $parametros['edic_cd']);
            $this->db->where('ativ_nm like ', $parametros['ativ_nm'].'%');
            $this->db->or_where('user_nm like ', $parametros['user_nm'].'%');
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

    public function consultarCodigo($codigo){
        $this->db->select('insc_cd, insc_status, insc_ativ_cd, insc_user_cd');
        $this->db->from('Inscricao');
        $this->db->where( 'insc_cd', $codigo );
        $query = $this->db->get();
        $consulta = $query->result_object()[0];
        $this->inscricao->setCodigo($consulta->insc_cd);
        $this->inscricao->setStatus($consulta->insc_status);
        $atividade = $this->AtividadeDAO->consultarCodigo($consulta->insc_ativ_cd);
        $this->inscricao->setAtividade($atividade);
        $usuario = $this->UsuarioDAO->consultarCodigo($consulta->insc_user_cd);
        $this->inscricao->setUsuario($usuario);
        return $this->inscricao;
    }

    public function excluir($obj) {
            $this->db->where( 'insc_ativ_cd', $obj );
        return $this->db->delete( 'Inscricao' );
    }
       
}
