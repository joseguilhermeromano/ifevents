<?php
if ( !defined('BASEPATH')) exit ( 'No direct sript access allowed' );
include_once 'UsuarioDAO.php';
class RevisorDAO extends UsuarioDAO{

    public function __construct(){
            parent::__construct('RevisorDAO');
            $this->load->model('RevisorModel', 'revisor');
            $this->load->model('dao/InstituicaoDAO');
            $this->load->Model( 'dao/ModalidadeTematicaDAO' );

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
            ,'user_biograf'     =>  $obj->getBiografia()
            ,'user_pass'        =>  $obj->getSenha()
            ,'user_status'      =>  $obj->getStatus()
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

        $this->db->select("  user_cd, user_nm, user_rg ,user_cpf, user_tipo, 
        user_biograf,user_status,user_pass, user_instituicao,email_email,tele_fone");

        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('Telefone', 'User.user_tele_cd = Telefone.tele_cd','left');
        $this->db->where('User.user_cd', $codigo);
        $query = $this->db->get();
        
        if($query->num_rows() == 0){
        	return null;
        }
        
        $consulta = $query->result_object()[0];
        $this->revisor->setCodigo($consulta->user_cd);
        $this->revisor->setNomeCompleto($consulta->user_nm);
        $instituicao = $this->InstituicaoDAO->consultarCodigo($consulta->user_instituicao);
        $this->revisor->setInstituicao($instituicao);
        $this->revisor->setRg($consulta->user_rg);
        $this->revisor->setCpf($consulta->user_cpf);
        $this->revisor->setBiografia($consulta->user_biograf);
        $this->revisor->setEmail($consulta->email_email);
        $this->revisor->setTelefone($consulta->tele_fone);
        $this->revisor->setSenha($consulta->user_pass);
        $this->revisor->setStatus($consulta->user_status);
        $this->consultaEndereco($this->revisor);
        
        return $this->revisor;
        
    }
    
    
    public function consultarRevisoresConvidados($parametros = null, $limite=null, 
        $numPagina=null, $sort='user_nm', $ordenacao='asc') {
        $this->db->select("user_cd, user_status, user_nm, Conferencia_Revisor.*");
        $this->db->from("User");
        $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
        $this->db->join('tipo_usuario', 'User.user_tipo = tipo_usuario.tius_cd','left');
        $this->db->join('Conferencia_Revisor', 'User.user_cd = Conferencia_Revisor.core_user_cd', '');
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
        if($query->num_rows()<=0){
            return null;
        }
        $revisores = $query->result_object();
        
        return $this->obtemModalidadesEixos($revisores);
    }
    
    public function totalRevisoresConvidados($conf_cd){
        $this->db->select("*");
        $this->db->from("Conferencia_Revisor");
        $this->db->where("core_conf_cd", $conf_cd);
        $this->db->where("core_convite_status", "Convite Aceito");
        $this->db->or_where("core_convite_status", "Aguardando Resposta");
        $query = $this->db->get();
        $total = $query->num_rows();
        return $total;
    }
    
    private function obtemModalidadesEixos($consulta){
        foreach ($consulta as $revisor) {
            $modalidadesEixos = $this->ModalidadeTematicaDAO
            ->consultarModaTemaRevisor($revisor->user_cd, $revisor->core_conf_cd);
            $revisor->modalidadesEixos = $this->stringModalidadesEixos($modalidadesEixos);
        }
        return $consulta;
    }
    
    private function stringModalidadesEixos($modalidadesEixos){
        $objeto = (object) array('modalidades' => null
            ,'eixos' => null);
        if($modalidadesEixos!== null){
            foreach ($modalidadesEixos as $key => $value) {
                if($value->mote_tipo == 0){
                  $objeto->modalidades .= $objeto->modalidades != '' ? ', ' : '';
                  $objeto->modalidades .= $value->mote_nm;
                }else{
                  $objeto->eixos .= $objeto->eixos != '' ? ', ' : '';
                  $objeto->eixos .= $value->mote_nm;
                }
            }
        }
        
        if($objeto->modalidades === null){
            $objeto->modalidades = 'Ainda não foi informado!';
        }
        
        if($objeto->eixos === null){
            $objeto->eixos = 'Ainda não foi informado!';
        }
        return $objeto;
    }
    
    public function convidarRevisor($revisor, $conferencia){
        $this->db->where('core_conf_cd', $conferencia);
        $this->db->where('core_user_cd', $revisor);
        $this->db->where('core_convite_status', 'Aguardando Resposta');
        $this->db->or_where('core_convite_status', 'Convite Recusado');
        $query = $this->db->get('Conferencia_Revisor');
        if($query->num_rows() == 0){
            $this->db->insert('Conferencia_Revisor', array(
                'core_conf_cd' => $conferencia
                ,'core_user_cd' => $revisor
                ,'core_convite_status' => 'Aguardando Resposta'
                ));
        }else{ 
            $this->session->set_flashdata('info', 'Você já adicionou este revisor ao evento!');
            return redirect('revisor/consultar-revisores'); 
        }

        if($this->db->affected_rows()){
            return 0;
        }
            return 1;
    }
    
    public function aceitarRecusarConvite($revisor, $evento, $opcao){
        $this->db->where('core_user_cd', $revisor);
        $this->db->where('core_conf_cd', $evento);
        $this->db->where('core_convite_status', 'Aguardando Resposta');
        $this->db->update('Conferencia_Revisor', array('core_convite_status' => $opcao));

        if($this->db->affected_rows()){
            return 0;
        }else{
            return 1;
        }
    }

    public function excluirConvite($revisor, $evento){
        $this->db->where('core_user_cd', $revisor);
        $this->db->where('core_conf_cd', $evento);
        $this->db->delete('Conferencia_Revisor');
        if($this->db->affected_rows()){
            return 0;
        }else{
            return 1;
        }
    }

}