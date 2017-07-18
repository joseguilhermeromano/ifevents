<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

class RevisorDAO extends CI_Model{

    public function __construct(){
            parent::__construct('RevisorDAO');
            $this->load->model('RevisorModel', 'revisor');
            $this->load->model('InstituicaoModel', 'instituicao');
            $this->load->model('dao/LocalidadeDAO');
            $this->load->model('dao/EmailDAO');
            $this->load->model('dao/TelefoneDAO');

    }


    public function inserir($obj) {
        $email_cd = $this->EmailDAO->inserir($obj->getEmail());
        $tele_cd = $this->TelefoneDAO->inserir($obj->getTelefone());

        $orig_db_debug = $this->db->db_debug;

        $this->db->db_debug = FALSE;

        $data = array(
            'user_nm'           =>  $obj->getNomeCompleto()
            ,'user_tipo'        =>  $obj->getTipoUsuario()
            ,'user_instituicao' =>  $obj->getInstituicao()->getCodigo()
            ,'user_biograf'     =>  $obj->getBiografia()
            ,'user_rg'          =>  $obj->getRg()
            ,'user_cpf'         =>  $obj->getCpf()
            ,'user_pass'        =>  $obj->getSenha()
            ,'user_status'      =>  $obj->getStatus()
            ,'user_tele_cd'     =>  $tele_cd
            ,'user_email_cd'    =>  $email_cd
        );

        $this->db->insert('User', $data);
        if($this->db->error()['code']==1062){
            throw new Exception('Já existe um usuário cadastrado com o mesmo documento RG!');
        }

        $this->db->db_debug = $orig_db_debug;

        $obj->setCodigo($this->db->insert_id());

        $this->LocalidadeDAO->inserirEnderecoUser($obj);
    }
    
    public function alterar($obj) {
        $orig_db_debug = $this->db->db_debug;

        $this->db->db_debug = FALSE;

        $data = array(
            'user_nm'           =>  $obj->getNomeCompleto()
            ,'user_tipo'        =>  $obj->getTipoUsuario()
            ,'user_instituicao' =>  $obj->getInstituicao()->getCodigo()
            ,'user_biograf'     =>  $obj->getBiografia()
            ,'user_rg'          =>  $obj->getRg()
            ,'user_cpf'         =>  $obj->getCpf()
            ,'user_pass'        =>  $obj->getSenha()
            ,'user_status'      =>  $obj->getStatus()
        );

        $consulta = $this->consultarCodigo($obj->getCodigo());
        if($consulta->getTelefone() != $obj->getTelefone()){
            $data['user_tele_cd'] = $this->TelefoneDAO->alterar($consulta->getTelefone(), $obj->getTelefone());
        }

        if($consulta->getEmail() != $obj->getEmail()){
            $data['user_email_cd'] = $this->EmailDAO->alterar($obj->getEmail());
        }

        $this->LocalidadeDAO->alterarEnderecoUser($obj);

        $this->db->where('user_cd',$obj->getCodigo());
        $this->db->update('User',$data);
        
        if($this->db->error()['code']==1062){
            throw new Exception('Já existe um usuário cadastrado com o mesmo documento RG!');
        }

        $this->db->db_debug = $orig_db_debug;
    }

    public function consultarCodigo($codigo){

        $this->db->select("  user_cd
                            ,user_nm
                            ,user_rg
                            ,user_cpf
                            ,user_tipo
                            ,user_biograf
                            ,email_email
                            ,tele_fone
                            ,inst_nm
                            ,inst_cd
                            ,inst_abrev
                            ,Localidade.*
                            ,abri_num
                            ,abri_comp");

        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('Telefone', 'User.user_tele_cd = Telefone.tele_cd','left');
        $this->db->join('Instituicao', 'User.user_instituicao = Instituicao.inst_cd','left');
        $this->db->join('Abriga', 'User.user_cd = Abriga.abri_user_cd','left');
        $this->db->join('Localidade', 'Abriga.abri_loca_cd = Localidade.loca_cd','left');
        $this->db->where('User.user_cd', $codigo);
        $query = $this->db->get();
        $consulta = $query->result_object()[0];

        if(empty($consulta)){
        	return null;
        }


        $this->revisor->setCodigo($consulta->user_cd);
        $this->revisor->setNomeCompleto($consulta->user_nm);
        $this->instituicao->setCodigo($consulta->inst_cd);
        $this->instituicao->setNome($consulta->inst_nm);
        $this->instituicao->setAbreviacao($consulta->inst_abrev);
        $this->revisor->setInstituicao($this->instituicao);
        $this->revisor->setRg($consulta->user_rg);
        $this->revisor->setCpf($consulta->user_cpf);
        $this->revisor->setBiografia($consulta->user_biograf);
        $this->revisor->setEmail($consulta->email_email);
        $this->revisor->setTelefone($consulta->tele_fone);
        $this->revisor->setCep($consulta->loca_cep);
        $this->revisor->setLogradouro($consulta->loca_lograd);
        $this->revisor->setBairro($consulta->loca_bairro);
        $this->revisor->setNumero($consulta->abri_num);
        $this->revisor->setComplemento($consulta->abri_comp);
        $this->revisor->setCidade($consulta->loca_cid);
        $this->revisor->setUf($consulta->loca_uf);
        
        return $this->revisor;
        
    }

}