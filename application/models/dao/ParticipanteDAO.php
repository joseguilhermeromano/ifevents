<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );
 include_once 'UsuarioDAO.php';
class ParticipanteDAO extends UsuarioDAO{

    public function __construct(){
            parent::__construct('ParticipanteDAO');
            $this->load->model('ParticipanteModel', 'participante');
            $this->load->model('dao/InstituicaoDAO');
    }
    
    private function obtemValores($obj){
        $instituicao = null;
        if($obj->getInstituicao()!==null){
            $instituicao = $obj->getInstituicao()->getCodigo();
        }
        return $data = array(
            'user_nm'           =>  $obj->getNomeCompleto()
            ,'user_tipo'        =>  $obj->getTipoUsuario()
            ,'user_instituicao' =>  $instituicao
            ,'user_rg'          =>  $obj->getRg()
            ,'user_cpf'         =>  $obj->getCpf()
            ,'user_pass'        =>  $obj->getSenha()
            ,'user_status'      =>  $obj->getStatus()
            ,'user_token'      =>  $obj->getToken()
            ,'user_tele_cd'     =>  $obj->getCodigoTelefone()
            ,'user_email_cd'    =>  $obj->getCodigoEmail()
        );
    }


    public function inserir($obj) {
        $obj->setCodigoEmail($this->insereAlteraEmail($obj->getEmail()));
        $obj->setCodigoTelefone($this->insereAlteraTelefone($obj->getTelefone()));
        $orig_db_debug = $this->db->db_debug;
        
        $this->db->db_debug = FALSE;
        $this->db->insert('User', $this->obtemValores($obj));
        if($this->db->error()['code']==1062){
            throw new Exception('Já existe um usuário cadastrado com o mesmo documento RG!');
        }

        $this->db->db_debug = $orig_db_debug;

        $obj->setCodigo($this->db->insert_id());
        $this->insereAlteraEndereco($obj);
    }


    public function alterar($obj) {
        $obj->setCodigoEmail($this->insereAlteraEmail($obj->getEmail()));
        $obj->setCodigoTelefone($this->insereAlteraTelefone($obj->getTelefone()));
        $orig_db_debug = $this->db->db_debug;

        $this->db->db_debug = FALSE;

        $this->insereAlteraEndereco($obj);

        $this->db->where('user_cd',$obj->getCodigo());
        $this->db->update('User',$this->obtemValores($obj));
        
        if($this->db->error()['code']==1062){
            throw new Exception('Já existe um usuário cadastrado com o mesmo documento RG!');
        }

        $this->db->db_debug = $orig_db_debug;
    }


    public function consultarCodigo($codigo){

        $this->db->select("  user_cd, user_nm, user_rg ,user_cpf, user_tipo,user_token,
                            user_status,user_pass, user_instituicao,email_email,tele_fone");

        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('Telefone', 'User.user_tele_cd = Telefone.tele_cd','left');
        $this->db->where('User.user_cd', $codigo);
        $query = $this->db->get();
       
        if($query->num_rows() == 0){
        	return null;
        }
        
        $consulta = $query->result_object()[0];
        $this->participante->setCodigo($consulta->user_cd);
        $this->participante->setNomeCompleto($consulta->user_nm);
        $instituicao = $this->InstituicaoDAO->consultarCodigo($consulta->user_instituicao);
        $this->participante->setInstituicao($instituicao);
        $this->participante->setRg($consulta->user_rg);
        $this->participante->setCpf($consulta->user_cpf);
        $this->participante->setEmail($consulta->email_email);
        $this->participante->setTelefone($consulta->tele_fone);
        $this->participante->setSenha($consulta->user_pass);
        $this->participante->setStatus($consulta->user_status);
        $this->participante->setToken($consulta->user_token);
        $this->consultaEndereco($this->participante);
        
        return $this->participante;
        
    }

}