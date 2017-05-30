<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class EdicaoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();
            $this->load->helper('html');
		}
                
        public function inserir($obj) {
            $this->db->insert('Edicao', 
                array(
                'edic_num' => $obj->edic_num
                ,'edic_tema' => $obj->edic_tema
                ,'edic_apresent' => $obj->edic_apresent
                ,'edic_link' => $obj->edic_link
                ,'edic_img' => $obj->edic_img
                ,'edic_regr_cd' => $obj->edic_regr_cd
                ,'edic_comi_cd' => $obj->edic_comi_cd
                ,'edic_conf_cd' => $obj->edic_conf_cd
                ,'edic_email_cd' => $obj->edic_email_cd
                ,'edic_tele_cd' => $obj->edic_tele_cd
                    ));
            $id = $this->db->insert_id();
            if(null !==$obj->parcerias){
                foreach ($obj->parcerias as $key => $value) {
                    $this->db->insert('Apoia', array('apoia_inst_cd' => $key,'apoia_edic_cd'=> $id));
                }
            }
            return $id;
        }
        
        public function alterar($obj) {
            $this->db->where('edic_cd', $obj->edic_cd);
            $this->db->update('edicao',
                array(
                'edic_num' => $obj->edic_num
                ,'edic_tema' => $obj->edic_tema
                ,'edic_apresent' => $obj->edic_apresent
                ,'edic_link' => $obj->edic_link
                ,'edic_img' => $obj->edic_img
                ,'edic_regr_cd' => $obj->edic_regr_cd
                ,'edic_comi_cd' => $obj->edic_comi_cd
                ,'edic_conf_cd' => $obj->edic_conf_cd
                ,'edic_email_cd' => $obj->edic_email_cd
                ,'edic_tele_cd' => $obj->edic_tele_cd
                    ));
            $this->db->where('apoia_edic_cd', $obj->edic_cd);
            $this->db->delete('Apoia');
            if(null !== $obj->parcerias){
                foreach ($obj->parcerias as $key => $value) {
                    $this->db->insert('Apoia', array('apoia_inst_cd' => $value->inst_cd,'apoia_edic_cd'=> $obj->edic_cd));
                }
            }
        }

        public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='edic_num', $ordenacao='asc') {
            $this->db->select("*");
            $this->db->from("Edicao");
            $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd','left');
            $this->db->join('Regra', 'Edicao.edic_regr_cd = Regra.regr_cd','left');
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

        public function consultarPorDataSubmissao($data_atual){
            $this->db->select("Edicao.*, Conferencia.*, Regra.*");
            $this->db->from("Edicao");
            $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd','left');
            $this->db->join('Regra', 'Edicao.edic_regr_cd = Regra.regr_cd','left');
            $this->db->where('Regra.regr_subm_abert <=', $data_atual);
            $this->db->where('Regra.regr_subm_encerr >=', $data_atual);
            $this->db->order_by('conf_abrev', 'asc');
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result_object();
            }else{
                return null;
            }
        }

        public function totalRegistros(){
            return $this->db->count_all("Edicao");
        }

        public function consultarUltimaEdicao($conf_cd){
            $this->db->select_max("edic_num");
            $this->db->from("Edicao");
            $this->db->where("edic_conf_cd",$conf_cd);
            $query = $this->db->get();
            if(isset($query->result_object()[0]->edic_num)){
                return $query->result_object()[0]->edic_num;
            }else{
                return 0;
            }
        }
        
        public function consultarCodigo($codigo){
            $this->db->select("Edicao.*, Conferencia.*, Comite.*, Instituicao.*,
             Regra.*, Localidade.*, Sedia.sedi_num, Sedia.sedi_comp, Email.*, Telefone.* ");
            $this->db->from("Edicao");
            $this->db->join('Regra', 'Edicao.edic_regr_cd = Regra.regr_cd','left');
            $this->db->join('Comite', 'Edicao.edic_comi_cd = Comite.comi_cd','left');
            $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd','left');
            $this->db->join('Email', 'Edicao.edic_email_cd = Email.email_cd','left');
            $this->db->join('Telefone', 'Edicao.edic_tele_cd = Telefone.tele_cd','left');
            $this->db->join('Sedia', 'Edicao.edic_cd = Sedia.sedi_edic_cd','left');
            $this->db->join('Localidade', 'Sedia.sedi_loca_cd = Localidade.loca_cd','left');
            $this->db->join('Apoia', 'Edicao.edic_cd = Apoia.apoia_edic_cd','left');
            $this->db->join('Instituicao', 'Apoia.apoia_inst_cd = Instituicao.inst_cd','left');
            $this->db->where('Edicao.edic_cd', $codigo);
            $query = $this->db->get();
            $query = $query->result_object();
            $parcerias = new ArrayObject();
            foreach ($query as $key => $value) {
                $parceria = (object) array();
                $parceria->inst_cd = $value->inst_cd;
                $parceria->inst_nm = $value->inst_nm;
                $parceria->inst_abrev = $value->inst_abrev;
                $parcerias->append($parceria);
            }

            //instancia objetos 
            $consulta = $query[0];
            $edicao = (object) array();
            $edicao->conferencia = (object) array();
            $edicao->comite = (object) array();
            $edicao->regra = (object) array();
            $edicao->localidade = (object) array();
            $edicao->telefone = (object) array();
            $edicao->email= (object) array();

            //alimenta objeto edicao
            $edicao->conferencia->conf_cd = $consulta->conf_cd;
            $edicao->conferencia->conf_abrev = $consulta->conf_abrev;
            $edicao->comite->comi_cd = $consulta->comi_cd;
            $edicao->comite->comi_nm = $consulta->comi_nm;
            $edicao->edic_cd = $consulta->edic_cd;
            $edicao->edic_num = $consulta->edic_num;
            $edicao->edic_email_cd = $consulta->edic_email_cd;
            $edicao->edic_tele_cd = $consulta->edic_tele_cd;
            $edicao->edic_tema = $consulta->edic_tema;
            $edicao->edic_link = $consulta->edic_link;
            $edicao->edic_img = $consulta->edic_img;
            $edicao->edic_apresent = $consulta->edic_apresent; 
            $edicao->parcerias = $parcerias;
            $edicao->regra->regr_cd = $consulta->regr_cd;
            $edicao->regra->regr_even_ini_dt = $consulta->regr_even_ini_dt;
            $edicao->regra->regr_even_fin_dt = $consulta->regr_even_fin_dt;
            $edicao->regra->regr_pub_ini_dt = $consulta->regr_pub_ini_dt;
            $edicao->regra->regr_pub_fin_dt = $consulta->regr_pub_fin_dt;
            $edicao->regra->regr_insc_ini_dt = $consulta->regr_insc_ini_dt;
            $edicao->regra->regr_insc_fin_dt = $consulta->regr_insc_fin_dt;
            $edicao->localidade->loca_cep = $consulta->loca_cep;
            $edicao->localidade->loca_lograd = $consulta->loca_lograd;
            $edicao->localidade->loca_bairro = $consulta->loca_bairro;
            $edicao->localidade->loca_num = $consulta->sedi_num;
            $edicao->localidade->loca_comp = $consulta->sedi_comp;
            $edicao->localidade->loca_cid = $consulta->loca_cid;
            $edicao->localidade->loca_uf = $consulta->loca_uf;
            $edicao->email->email_cd = $consulta->email_cd;
            $edicao->email->email_email = $consulta->email_email; 
            $edicao->telefone->tele_cd = $consulta->tele_cd;
            $edicao->telefone->tele_fone = $consulta->tele_fone;    
            return $edicao;

        }

        public function consultarRevisores($parametros = null, $limite=null, $numPagina=null, $sort='user_nm', $ordenacao='asc') {
            $this->db->select("User.*, Conferencia_Revisor.*");
            $this->db->from("User");
            $this->db->join('Email', 'User.user_email_cd = Email.email_cd','left');
            $this->db->join('tipo_usuario', 'User.user_tipo = tipo_usuario.tius_cd','left');
            $this->db->join('Status', 'User.user_stat_cd = Status.stat_cd','left');
            $this->db->join('Conferencia_Revisor', 'User.user_cd = Conferencia_Revisor.core_user_cd', '');
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

        public function totalRegistrosRevisores(){
            return 0;
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
                return redirect('revisor/consultar'); 
            }

            if($this->db->affected_rows()){
                return 0;
            }else{
                return 1;
            }

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

        public function consultarEventosRevisor($data_atual, $revisor){
            $this->db->select("Conferencia_Revisor.*, Edicao.edic_conf_cd");
            $this->db->from("Conferencia_Revisor, Mote_Revisor");
            $this->db->join('Edicao', 'Conferencia_Revisor.core_conf_cd = Edicao.edic_conf_cd','left');
            $this->db->join('Modalidade_Tematica', 
                'Conferencia_Revisor.core_conf_cd = Modalidade_Tematica.mote_conf_cd','left');
            $this->db->join('Regra', 'Edicao.edic_regr_cd = Regra.regr_cd','left');
            $this->db->where('Regra.regr_revi_abert <=', $data_atual);
            $this->db->where('Regra.regr_revi_encerr >=', $data_atual);
            $this->db->where('Conferencia_Revisor.core_user_cd', $revisor);
            $this->db->where('Conferencia_Revisor.core_convite_status', 'Convite Aceito');
            $this->db->where('mote_cd NOT IN (SELECT more_mote_cd FROM Mote_Revisor where more_user_cd = '.$revisor.')');
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result_object();
            }else{
                return null;
            }
        }

        public function excluir($obj) {
            $this->db->where('ende_id', $obj->ende_id);
            return $this->db->delete('edicao');
        }
            

}





