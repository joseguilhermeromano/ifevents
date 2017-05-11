<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

    include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class UserDAO extends CI_Model implements DAO{

    public function __construct(){
            parent::__construct('UserDAO');
    }

    public function inserir($obj) {
            $orig_db_debug = $this->db->db_debug;

            $this->db->db_debug = FALSE;
            $this->db->insert('User', $obj);
            if($this->db->error()['code']==1062){
                throw new Exception('Já existe um usuário cadastrado com o mesmo documento RG!');
            }

            $this->db->db_debug = $orig_db_debug;
            return $this->db->insert_id();
    }
    
    public function alterar($obj) {
        $this->db->where('user_cd',$obj->user_cd);
        $this->db->update('User',$obj);
    }

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='user_nm', $ordenacao='asc') {
        $this->db->select("User.*,email_email, tius_nm, stat_nm");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('tipo_usuario', 'User.user_tipo = tipo_usuario.tius_cd','left');
        $this->db->join('Status', 'User.user_stat_cd = Status.stat_cd','left');
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

    public function consultarRevisores($parametros = null, $limite=null, $numPagina=null, $sort='user_nm', $ordenacao='asc') {
        $this->db->select("User.*, Edicao_Revisor.*");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('tipo_usuario', 'User.user_tipo = tipo_usuario.tius_cd','left');
        $this->db->join('Status', 'User.user_stat_cd = Status.stat_cd','left');
        $this->db->join('Edicao_Revisor', 'User.user_cd = Edicao_Revisor.edre_user_cd');
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
    
    public function consultarCodigo($codigo){

        $this->db->select("User.*,email_email, tele_fone, inst_nm, Localidade.*, abri_num, abri_comp");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('Telefone', 'User.user_tele_cd = Telefone.tele_cd','left');
        $this->db->join('Instituicao', 'User.user_instituicao = Instituicao.inst_cd','left');
        $this->db->join('Abriga', 'User.user_cd = Abriga.abri_user_cd','left');
        $this->db->join('Localidade', 'Abriga.abri_loca_cd = Localidade.loca_cd','left');
        $this->db->where('User.user_cd', $codigo);
        $query = $this->db->get();
        $consulta = $query->result_object();

        $user = new UserModel();
        $loca = new LocalidadeModel();
        $email = new EmailModel();
        $telefone = new TelefoneModel();
        $inst = new InstituicaoModel();

        foreach ($consulta as $key => $value) {

            if(empty($user->user_cd)){
                $user->user_cd = $value->user_cd;
                $user->user_nm = $value->user_nm;
                $user->user_tipo = $value->user_tipo;
                $useruser_instituicao = $value->user_instituicao;
                $user->user_biograf = $value->user_biograf;
                $user->user_rg = $value->user_rg;
                $user->user_cpf = $value->user_cpf;
                $user->user_edic_cd = $value->user_edic_cd;
                $user->user_email_cd = $value->user_email_cd;
                $user->user_pass = $value->user_pass;
                $user->user_tele_cd = $value->user_tele_cd;
                $user->user_stat_cd = $value->user_stat_cd;
            }

            if(empty($loca->loca_cd)){
                $loca->loca_cd = $value->loca_cd;
                $loca->loca_lograd = $value->loca_lograd;
                $loca->loca_bairro = $value->loca_bairro;
                $loca->loca_cep = $value->loca_cep;
                $loca->loca_cid = $value->loca_cid;
                $loca->loca_uf = $value->loca_uf;
                $loca->loca_num = $value->abri_num;
                $loca->loca_comp = $value->abri_comp;
            }
            if(empty($email->email_email)){
                $email->email_email = $value->email_email;
            }
            if(empty($telefone->tele_fone)){
                $telefone->tele_fone = $value->tele_fone;
            }
            if(empty($inst->inst_nm)){
                $inst->inst_cd = $value->user_instituicao;
                $inst->inst_nm = $value->inst_nm;
            }

        }
         $data = array('user'=>$user, 'localidade' => $loca, 'email'=> $email, 'telefone' => $telefone, 'instituicao' => $inst);
        return $data;
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
        $this->db->select("*");
        $this->db->from("Email");
        $this->db->join('User', 'User.user_email_cd = Email.email_cd');
        $this->db->where('Email.email_email', $email);
        $this->db->where('User.user_pass',$senha);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ativaDesativa($user_cd, $situacao){
        $this->db->where('user_cd',$user_cd);
        $this->db->update('User',array('user_stat_cd' => $situacao));
        if($this->db->affected_rows()){
            return 0;
        }else{
            return 1;
        }
    }

    public function excluir($obj) {
    }

}