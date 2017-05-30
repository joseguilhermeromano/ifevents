<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );

    include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class UsuarioDAO extends CI_Model implements DAO{

    public function __construct(){
            parent::__construct('UsuarioDAO');
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
            ,'user_biograf'     =>  $obj->getTipoUsuario() == 2 ? $obj->getBiografia() : null
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
            ,'user_biograf'     =>  $obj->getTipoUsuario() == 2 ? $obj->getBiografia() : null
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
    
    public function consultarCodigo($codigo){

        $this->db->select("  user_cd
                            ,user_nm
                            ,user_biograf
                            ,user_rg
                            ,user_cpf
                            ,user_tipo
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

        switch ($consulta->user_tipo) {
            case '3':
                return $this->retornaOrganizador($consulta);
                break;

            case '2':
                return $this->retornaRevisor($consulta);
                break;
            
            default:
                return $this->retornaParticipante($consulta);
                break;
        }
    }

    private function retornaParticipante($consulta){
        $this->load->model('ParticipanteModel');
        $participante = new ParticipanteModel();
        $participante->setCodigo($consulta->user_cd);
        $participante->setNomeCompleto($consulta->user_nm);
        
        $this->instituicao->setCodigo($consulta->inst_cd);
        $this->instituicao->setNome($consulta->inst_nm);
        $this->instituicao->setAbreviacao($consulta->inst_abrev);

        $participante->setInstituicao($this->instituicao);
        $participante->setRg($consulta->user_rg);
        $participante->setCpf($consulta->user_cpf);
        $participante->setEmail($consulta->email_email);
        $participante->setTelefone($consulta->tele_fone);
        $participante->setCep($consulta->loca_cep);
        $participante->setLogradouro($consulta->loca_lograd);
        $participante->setBairro($consulta->loca_bairro);
        $participante->setNumero($consulta->abri_num);
        $participante->setComplemento($consulta->abri_comp);
        $participante->setCidade($consulta->loca_cid);
        $participante->setUf($consulta->loca_uf);
        return $participante;
    }

    private function retornaRevisor($consulta){
        $this->load->model('RevisorModel');
        $revisor = new RevisorModel();
        $revisor->setCodigo($consulta->user_cd);
        $revisor->setNomeCompleto($consulta->user_nm);
        $this->instituicao->setCodigo($consulta->inst_cd);
        $this->instituicao->setNome($consulta->inst_nm);
        $this->instituicao->setAbreviacao($consulta->inst_abrev);
        $revisor->setInstituicao($this->instituicao);
        $revisor->setRg($consulta->user_rg);
        $revisor->setCpf($consulta->user_cpf);
        $revisor->setEmail($consulta->email_email);
        $revisor->setTelefone($consulta->tele_fone);
        $revisor->setBiografia($consulta->user_biograf);
        $revisor->setCep($consulta->loca_cep);
        $revisor->setLogradouro($consulta->loca_lograd);
        $revisor->setBairro($consulta->loca_bairro);
        $revisor->setNumero($consulta->abri_num);
        $revisor->setComplemento($consulta->abri_comp);
        $revisor->setCidade($consulta->loca_cid);
        $revisor->setUf($consulta->loca_uf);
        return $revisor;
    }

    private function retornaOrganizador($consulta){
        $this->load->model('OrganizadorModel');
        $organizador = new OrganizadorModel();
        $organizador->setCodigo($consulta->user_cd);
        $organizador->setNomeCompleto($consulta->user_nm);
        $this->instituicao->setCodigo($consulta->inst_cd);
        $this->instituicao->setNome($consulta->inst_nm);
        $this->instituicao->setAbreviacao($consulta->inst_abrev);
        $organizador->setInstituicao($this->instituicao);
        $organizador->setRg($consulta->user_rg);
        $organizador->setCpf($consulta->user_cpf);
        $organizador->setEmail($consulta->email_email);
        $organizador->setTelefone($consulta->tele_fone);
        $organizador->setCep($consulta->loca_cep);
        $organizador->setLogradouro($consulta->loca_lograd);
        $organizador->setBairro($consulta->loca_bairro);
        $organizador->setNumero($consulta->abri_num);
        $organizador->setComplemento($consulta->abri_comp);
        $organizador->setCidade($consulta->loca_cid);
        $organizador->setUf($consulta->loca_uf);
        return $organizador;
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



    public function excluir($obj) {
    }

}