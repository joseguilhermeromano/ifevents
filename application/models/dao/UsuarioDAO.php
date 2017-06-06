<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

class UsuarioDAO extends CI_Model{

    public function __construct(){
            parent::__construct('UsuarioDAO');
            $this->load->model('InstituicaoModel', 'instituicao');
            $this->load->model('dao/LocalidadeDAO');
            $this->load->model('dao/EmailDAO');
            $this->load->model('dao/TelefoneDAO');

    }

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='user_nm', $ordenacao='asc') {
        $this->db->select("user_nm, user_status, user_tipo, user_cd, email_email, tius_nm");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('tipo_usuario', 'User.user_tipo = tipo_usuario.tius_cd','left');
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

    public function totalRegistros(){
        return $this->db->count_all("User");
    }

    public function consultarPorNome($nome, $campo='user_nm', $ordenacao='asc', $limite=null, $numPagina=null){
        $this->db->select("User.*,email_email, tius_nm, stat_nm");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('tipo_usuario', 'User.user_tipo = tipo_usuario.tius_cd','left');
        $this->db->join('Status', 'User.user_stat_cd = Status.stat_cd','left');
        $this->db->where('user_nm LIKE', '%'.$nome.'%');
        $this->db->order_by($campo, $ordenacao);
        if($limite)
            $this->db->limit($limite, $numPagina);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result_object();
        }else{
            return null;
        }
    }
    
    public function consultarLogin($email, $senha){
        $this->db->select("user_cd, user_nm, user_tipo");
        $this->db->from("Email");
        $this->db->join('User', 'User.user_email_cd = Email.email_cd');
        $this->db->where('Email.email_email', $email);
        $this->db->where('User.user_pass',$senha);
        $query = $this->db->get();
        return $query->result_object()[0];
    }

    public function ativaDesativa($user_cd, $situacao){
        $this->db->where('user_cd',$user_cd);
        $this->db->update('User',array('user_status' => $situacao));
        if($this->db->affected_rows()){
            return 0;
        }else{
            return 1;
        }
    }

}