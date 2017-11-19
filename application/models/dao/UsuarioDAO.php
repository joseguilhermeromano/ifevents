<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

class UsuarioDAO extends CI_Model{

    public function __construct(){
            parent::__construct('UsuarioDAO');
        $this->load->model('InstituicaoModel', 'instituicao');
        $this->load->model('dao/OrganizadorDAO');
        $this->load->model('dao/ParticipanteDAO');
        $this->load->model('dao/RevisorDAO');
    }
    
    public function insereAlteraEmail($email){
        $this->db->select('*');
        $this->db->from('Email');
        $this->db->where('email_email', $email);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_object()[0]->email_cd;
        }

        $orig_db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $this->db->insert('Email', array('email_email' => $email));
        $this->db->db_debug = $orig_db_debug;
        return $this->db->insert_id();
    }
        
    public function insereAlteraTelefone($telefone){
        //Verifica se telefone já está cadastrado, caso afirmativo ele retorna o codigo do telefone
        $this->db->select('*');
        $this->db->from('Telefone');
        $this->db->where('tele_fone', $telefone);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_object()[0]->tele_cd;
        }

        //Cadastra um novo telefone
        $this->db->insert('Telefone', array('tele_fone' => $telefone));
        return $this->db->insert_id();
    }
        
    public function insereAlteraEndereco($obj){
        $consulta = $this->consultarCep($obj->getCep());
        $parametros = array('loca_lograd' => $obj->getLogradouro()
                ,'loca_bairro' => $obj->getBairro()
                ,'loca_cid' => $obj->getCidade()
                ,'loca_cep' => $obj->getCep()
                ,'loca_uf' => $obj->getUf()
                );
        if(empty($consulta)){
            $this->db->insert('Localidade',$parametros);
            $codigoLocalidade = $this->db->insert_id();
        }else{
            $codigoLocalidade = $consulta->loca_cd;
            $this->db->where('loca_cd', $codigoLocalidade);
            $this->db->update('Localidade', $parametros);
        }
        $this->insereAlteraAbrigo($obj, $codigoLocalidade);
    }
    
    private function insereAlteraAbrigo($obj, $codigoLocalidade){
        $parametros = array('abri_loca_cd' => $codigoLocalidade
                ,'abri_user_cd' => $obj->getCodigo()
                ,'abri_num' => $obj->getNumero()
                ,'abri_comp' => $obj->getComplemento());
        $this->db->select("*");
        $this->db->from("Abriga");
        $this->db->where("abri_user_cd", $obj->getCodigo());
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $this->db->where('abri_user_cd', $obj->getCodigo());
            $this->db->update('Abriga', $parametros);
        }else{
            $this->db->insert('Abriga',$parametros);
        }
    }
        
    public function consultarCep($cep) {
        $this->db->select("*");
        $this->db->from("Localidade");
        $this->db->where('Localidade.loca_cep',  $cep);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_object()[0];
        }
        return null;
    }
    
    public function consultaEndereco($obj){
        $this->db->select("Localidade.*, Abriga.*");
        $this->db->from("Abriga");
        $this->db->join('Localidade', 'Abriga.abri_loca_cd = Localidade.loca_cd','left');
        $this->db->where('Abriga.abri_user_cd', $obj->getCodigo());
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $consulta = $query->result_object()[0];
            $obj->setCep($consulta->loca_cep);
            $obj->setLogradouro($consulta->loca_lograd);
            $obj->setBairro($consulta->loca_bairro);
            $obj->setNumero($consulta->abri_num);
            $obj->setComplemento($consulta->abri_comp);
            $obj->setCidade($consulta->loca_cid);
            $obj->setUf($consulta->loca_uf);
        }
    }

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null, 
        $sort='user_nm', $ordenacao='asc') {
        $this->db->select("user_nm, user_status,user_token, user_tipo, user_cd, email_email, tius_nm");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('tipo_usuario', 'User.user_tipo = tipo_usuario.tius_cd','left');
        $this->db->order_by($sort, $ordenacao);
        if($parametros !== null){
            if(isset($parametros['user_token'])){
                $this->db->where('user_token',$parametros['user_token']);
            }else{
                $this->db->or_where('user_nm LIKE ',$parametros['user_nm'].'%');
                $this->db->or_where('email_email LIKE ',$parametros['email_email'].'%');
            }
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
        $this->db->select("user_cd, user_nm, user_tipo, email_email, user_status");
        $this->db->from("Email");
        $this->db->join('User', 'User.user_email_cd = Email.email_cd');
        $this->db->where('Email.email_email', $email);
        $this->db->where('User.user_pass',$senha);
        $query = $this->db->get();
        return $query->result_object()[0];
    }
    
    public function consultarCodigo($codigo){
        $this->db->select("user_tipo");
        $this->db->from("User");
        $this->db->where('user_cd', $codigo);
        $query = $this->db->get();
        $tipo = $query->result_object()[0]->user_tipo;
        $user= null;
        switch($tipo){
            case "3":
                $user = $this->OrganizadorDAO->consultarCodigo($codigo);
                break;
            case "2":
                $user = $this->RevisorDAO->consultarCodigo($codigo);
                break;
            default:
                $user = $this->ParticipanteDAO->consultarCodigo($codigo);
        }
        return $user;
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
    
    public function redefinirSenha($token, $novaSenha){
        $this->db->where('user_token', $token);
        $this->db->update('User', array('user_pass' => $novaSenha));
        if($this->db->affected_rows()){
            return 0;
        }else{
            return 1;
        }
    }

}