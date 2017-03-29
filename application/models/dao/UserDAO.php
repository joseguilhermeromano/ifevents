<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

    include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class UserDAO extends CI_Model implements DAO{

    public function __construct(){
            parent::__construct('UserDAO');
    }

    public function inserir($obj) {
        $this->db->insert('user', $obj);
        return $this->db->insert_id();
    }
    
    public function alterar($obj) {
        $this->db->where('user_cd',$obj->user_cd);
        $this->db->update('user',$obj);
    }

    public function consultarTudo() {
        return null;
    }
    
    public function consultarCodigo($codigo){

        $this->db->select("User.*,email_email, tele_fone, inst_nm, localidade.*, enus_num, enus_comp");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_cd = Email.email_user_cd','left outer');
        $this->db->join('Telefone', 'User.user_cd = Telefone.tele_user_cd','left outer');
        $this->db->join('Instituicao', 'User.user_instituicao = Instituicao.inst_cd','left');
        $this->db->join('user_loca_ende', 'User.user_cd = user_loca_ende.ule_user_cd','left');
        $this->db->join('localidade', 'user_loca_ende.ule_loca_cd = localidade.loca_cd','left');
        $this->db->join('endereco_user', 'user_loca_ende.ule_ende_cd = endereco_user.enus_cd','left');
        $this->db->where('User.user_cd', $codigo);
        $query = $this->db->get();
        $consulta = $query->result_object();
        $user = new UserModel();
        $loca = new LocalidadeModel();
        $emails= array();
        $telefones = array();
        $inst = new InstituicaoModel();
        $indexEmail = 0;
        $indexTele = 1;

        foreach ($consulta as $key => $value) {

            if(empty($user->user_cd)){
                $user->user_cd = $value->user_cd;
                $user->user_nm = $value->user_nm;
                $user->user_cd = $value->user_cd;
                $user->user_tipo = $value->user_tipo;
                $useruser_instituicao = $value->user_instituicao;
                $user->user_biograf = $value->user_biograf;
                $user->user_rg = $value->user_rg;
                $user->user_cpf = $value->user_cpf;
                $user->user_qtd_subm = $value->user_qtd_subm;
                $user->user_pass = $value->user_pass;
                $user->user_email_vali = $value->user_email_vali;
                $user->user_stat_cd = $value->user_stat_cd;
                $user->user_rg = $value->user_rg;
            }

            if(empty($loca->loca_cd)){
                $loca->loca_cd = $value->loca_cd;
                $loca->loca_lograd = $value->loca_lograd;
                $loca->loca_bairro = $value->loca_bairro;
                $loca->loca_cep = $value->loca_cep;
                $loca->loca_cid = $value->loca_cid;
                $loca->loca_uf = $value->loca_uf;
                $loca->enus_num = $value->enus_num;
                $loca->enus_comp = $value->enus_comp;
            }
            !in_array($value->email_email, $emails) ? $emails[$indexEmail++] = $value->email_email : '';
            !in_array($value->tele_fone, $telefones) ? $telefones[$indexTele++] = $value->tele_fone : '';
            if(empty($inst->inst_nm)){
                $inst->inst_cd = $value->user_instituicao;
                $inst->inst_nm = $value->inst_nm;
            }

        }
         $data = array('user'=>$user, 'localidade' => $loca, 'emails'=> $emails, 'telefones' => $telefones, 'instituicao' => $inst);
        return $data;
    }
    
    public function consultarLogin($email, $senha){
        $this->db->select("*");
        $this->db->from("Email");
        $this->db->join('User', 'User.user_cd = Email.email_user_cd');
        $this->db->where('Email.email_email', $email);
        $this->db->where('Email.email_principal', 1);
        $this->db->where('User.user_pass',$senha);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function excluir($obj) {
        $this->db->where('user_id', $obj->user_id);
        return $this->db->delete('user');
    }

}