<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
        
        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class EdicaoDAO extends CI_Model implements DAO{

        public function __construct(){
                parent::__construct();
                $this->load->helper('html');
                $this->load->model('EdicaoModel', 'edicao');
                $this->load->model('ConferenciaModel', 'conferencia');
                $this->load->model('InstituicaoModel', 'instituicao');
                $this->load->model('ComiteModel', 'comite');
                $this->load->model('dao/ConferenciaDAO');
                $this->load->model('dao/ComiteDAO');
        }
                
        public function inserir($obj) {
            
            $obj->setCodigoRegra($this->insereRegras($obj));
            $obj->setCodigoEmail($this->insereAlteraEmail($obj->getEmail()));
            $obj->setCodigoTelefone($this->insereAlteraTelefone($obj->getTelefone()));
            
            $this->db->insert('Edicao', $this->setaValoresEdicao($obj));
            
            $obj->setCodigo($this->db->insert_id());
            
            $this->inserirEnderecoEdicao($obj);
            $this->insereAlteraParcerias($obj);
            
        }
        
        private function setaValoresEdicao($obj){
            return array(
                'edic_num' => $obj->getNumeroEdicao()
                ,'edic_tema' => $obj->getTema()
                ,'edic_apresent' => $obj->getApresentacao()
                ,'edic_link' => $obj->getLinkEdicao()
                ,'edic_img' => $obj->getImagemEdicao()
                ,'edic_regr_cd' => $obj->getCodigoRegra()
                ,'edic_comi_cd' => $obj->getComite()->getCodigo()
                ,'edic_conf_cd' => $obj->getConferencia()->getCodigo()
                ,'edic_anais' => $obj->getAnais()
                ,'edic_result' => $obj->getResultados()
                ,'edic_email_cd' => $obj->getCodigoEmail()
                ,'edic_tele_cd' => $obj->getCodigoTelefone()
                    );
        }
        
        private function setaValoresRegras($obj){
            return array(
               'regr_even_ini_dt' => converteDataMysql($obj->getDataInicioEvento())
               ,'regr_even_fin_dt' => converteDataMysql($obj->getDataFimEvento())
               ,'regr_pub_ini_dt' => converteDataMysql($obj->getDataInicioPublicacao())
               ,'regr_pub_fin_dt' => converteDataMysql($obj->getDataFimPublicacao())
               ,'regr_insc_ini_dt' => converteDataMysql($obj->getDataInicioInscricao())
               ,'regr_insc_fin_dt' => converteDataMysql($obj->getDataFimInscricao())
               ,'regr_subm_abert' => converteDataMysql($obj->getDataInicioSubmissao())
               ,'regr_subm_encerr' => converteDataMysql($obj->getDataFimSubmissao())
               ,'regr_revi_abert' => converteDataMysql($obj->getDataInicioAvaliacao())
               ,'regr_revi_encerr' => converteDataMysql($obj->getDataFimAvaliacao())
               ,'regr_dire_subm' => $obj->getDiretrizesSubmissao()
               ,'regr_dire_aval' => $obj->getDiretrizesAvaliacao()
               );
        }
        
        private function insereAlteraParcerias($obj){
            $this->db->delete('Apoia', array('apoia_edic_cd' => 22));
            if(null !==$obj->getParcerias()){
                foreach ($obj->getParcerias() as $key => $value) {
                    $this->db->insert('Apoia', 
                    array('apoia_inst_cd' => $value->getCodigo()
                    ,'apoia_edic_cd'=> $obj->getCodigo()));
                }
            }
        }
        
        private function insereAlteraEmail($email){
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
        
        private function insereAlteraTelefone($telefone){
            //Verifica se telefone já está cadastrado, caso afirmativo ele retorna o codigo do telefone
            $this->db->select('*');
            $this->db->from('Telefone');
            $this->db->where('tele_fone', $telefone);
            $query = $this->db->get();
            if(isset($query->result_object()[0])){
                return $query->result_object()[0]->tele_cd;
            }
            
            //Cadastra um novo telefone
            $this->db->insert('Telefone', array('tele_fone' => $telefone));
            return $this->db->insert_id();
        }
        
        private function insereRegras($obj){
            $this->db->insert('Regra',$this->setaValoresRegras($obj));
           return $this->db->insert_id();
        }
        
        public function alteraRegras($obj){
            $this->db->where('regr_cd', $obj->getCodigoRegra());
            $this->db->update('regra',$this->setaValoresRegras($obj));
        }
        
        public function alterar($obj) {
            $this->alteraRegras($obj);
            $obj->setCodigoEmail($this->insereAlteraEmail($obj->getEmail()));
            $obj->setCodigoTelefone($this->insereAlteraTelefone($obj->getTelefone()));
            $this->db->where('edic_cd', $obj->getCodigo());
            $this->db->update('edicao',$this->setaValoresEdicao($obj));
            $this->insereAlteraEnderecoEdicao($obj);
            $this->insereAlteraParcerias($obj);
        }
        
        private function insereAlteraEnderecoEdicao($obj){
            $consulta = $this->consultarCep($obj->getCep());
            $codigoLocalidade = $consulta->loca_cd;
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
                $this->db->where('loca_cd', $codigoLocalidade);
                $this->db->update('Localidade', $parametros);
            }
            $this->insereAlteraSede($obj, $codigoLocalidade);
        }
        
        private function insereAlteraSede($obj, $codigoLocalidade){
            $parametros = array('sedi_loca_cd' => $codigoLocalidade
                    ,'sedi_edic_cd' => $obj->getCodigo()
                    ,'sedi_num' => $obj->getNumero()
                    ,'sedi_comp' => $obj->getComplemento());
            $this->db->select("*");
            $this->db->from("Sedia");
            $this->db->where("sedi_edic_cd", $obj->getCodigo());
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $this->db->where('sedi_edic_cd', $obj->getCodigo());
                $this->db->update('Sedia', $parametros);
            }else{
                $this->db->insert('Sedia',$parametros);
            }
        }
        
        private function consultarCep($cep) {
            $this->db->select("*");
            $this->db->from("Localidade");
            $this->db->where('Localidade.loca_cep',  $cep);
            $query = $this->db->get();
            return $query->result_object()[0];
        }

        public function consultarTudo($parametros = null, $limite=null, 
                $numPagina=null, $sort='edic_num', $ordenacao='asc') {
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
            if($limite){
                $this->db->limit($limite, $numPagina);
            }
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
            $this->db->select("Edicao.*, Email.*, Telefone.* ");
            $this->db->from("Edicao");
            $this->db->join('Email', 'Edicao.edic_email_cd = Email.email_cd','left');
            $this->db->join('Telefone', 'Edicao.edic_tele_cd = Telefone.tele_cd','left');
            $this->db->where('Edicao.edic_cd', $codigo);
            $query = $this->db->get();
            $consulta = $query->result_object()[0];
            return $this->setaValores($consulta);
        }
        
        public function consultarPorLink($uri){
            $this->db->select("Edicao.*, Email.*, Telefone.* ");
            $this->db->from("Edicao");
            $this->db->join('Email', 'Edicao.edic_email_cd = Email.email_cd','left');
            $this->db->join('Telefone', 'Edicao.edic_tele_cd = Telefone.tele_cd','left');
            $this->db->where('Edicao.edic_link', $uri);
            $query = $this->db->get();
            $consulta = $query->result_object()[0];
            return $this->setaValores($consulta);
        }
        
        private function setaValores($consulta){
            $conferencia = $this->ConferenciaDAO->consultarCodigo($consulta->edic_conf_cd);
            $comite = $this->ComiteDAO->consultarCodigo($consulta->edic_comi_cd);
            $this->edicao->setConferencia($conferencia);
            $this->edicao->setComite($comite);
            $codigoEdicao = $consulta->edic_cd;
            $this->edicao->setParcerias($this->consultaParcerias($codigoEdicao));
            $this->edicao->setCodigo($codigoEdicao);
            $this->edicao->setNumeroEdicao($consulta->edic_num);
            $this->edicao->setCodigoEmail($consulta->edic_email_cd);
            $this->edicao->setCodigoTelefone($consulta->edic_tele_cd);
            $this->edicao->setTema($consulta->edic_tema);
            $this->edicao->setLinkEdicao($consulta->edic_link);
            $this->edicao->setImagemEdicao($consulta->edic_img);
            $this->edicao->setApresentacao($consulta->edic_apresent); 
            $this->edicao->setEmail($consulta->email_email); 
            $this->edicao->setTelefone($consulta->tele_fone);
            $this->edicao->setResultados($consulta->edic_result);
            $this->edicao->setAnais($consulta->edic_anais);
            $this->consultaEnderecoEdicao($codigoEdicao);
            $this->consultaRegras($consulta->edic_regr_cd);
            return $this->edicao;
        }
        
        private function consultaEnderecoEdicao($codigo){
            $this->db->select("Localidade.*, Sedia.*");
            $this->db->from("Sedia");
            $this->db->join('Localidade', 'Sedia.sedi_loca_cd = Localidade.loca_cd','left');
            $this->db->where('Sedia.sedi_edic_cd', $codigo);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $consulta = $query->result_object()[0];
                $this->edicao->setCep($consulta->loca_cep);
                $this->edicao->setLogradouro($consulta->loca_lograd);
                $this->edicao->setBairro($consulta->loca_bairro);
                $this->edicao->setNumero($consulta->sedi_num);
                $this->edicao->setComplemento($consulta->sedi_comp);
                $this->edicao->setCidade($consulta->loca_cid);
                $this->edicao->setUf($consulta->loca_uf);
            }
        }
        
        private function consultaRegras($codigo){
            $this->db->select("*");
            $this->db->from("Regra");
            $this->db->where('regr_cd', $codigo);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $consulta = $query->result_object()[0];
                $this->edicao->setCodigoRegra($consulta->regr_cd); 
                $this->edicao->setDataInicioEvento(
                        desconverteDataMysql($consulta->regr_even_ini_dt));
                $this->edicao->setDataFimEvento(
                        desconverteDataMysql($consulta->regr_even_fin_dt));
                $this->edicao->setDataInicioPublicacao(
                        desconverteDataMysql($consulta->regr_pub_ini_dt));
                $this->edicao->setDataFimPublicacao(
                        desconverteDataMysql($consulta->regr_pub_fin_dt));
                $this->edicao->setDataInicioInscricao(
                        desconverteDataMysql($consulta->regr_insc_ini_dt));
                $this->edicao->setDataFimInscricao(
                        desconverteDataMysql($consulta->regr_insc_fin_dt));
                $this->edicao->setDataInicioSubmissao(
                        desconverteDataMysql($consulta->regr_subm_abert));
                $this->edicao->setDataFimSubmissao(
                        desconverteDataMysql($consulta->regr_subm_encerr));
                $this->edicao->setDataInicioAvaliacao(
                        desconverteDataMysql($consulta->regr_revi_abert));
                $this->edicao->setDataFimAvaliacao(
                        desconverteDataMysql($consulta->regr_revi_encerr));
                $this->edicao->setDiretrizesSubmissao($consulta->regr_dire_subm);
                $this->edicao->setDiretrizesAvaliacao($consulta->regr_dire_aval);
            }
        }
        
        private function consultaParcerias($codigoEdicao){
             $this->db->select("*");
             $this->db->from("Instituicao");
             $this->db->join('Apoia', 'Instituicao.inst_cd = Apoia.apoia_inst_cd','left');
             $this->db->where('Apoia.apoia_edic_cd', $codigoEdicao);
             $query = $this->db->get();
             if($query->num_rows() > 0){
                $consulta = $query->result();
                $parcerias = new ArrayObject();
                foreach ($consulta as $key => $obj) {
                    $parceria = new $this->instituicao;
                    $parceria->setCodigo($obj->inst_cd);
                    $parceria->setNome($obj->inst_nm);
                    $parceria->setAbreviacao($obj->inst_abrev);
                    $parceria->setDescricao($obj->inst_desc);
                    $parceria->setLogo($obj->inst_logo);
                    $parcerias->append($parceria);
                }
                return $parcerias;
             }
             return null;
        }

        public function consultarUltimoEventoRevisor($dataAtual, $codigoRevisor){
            $this->db->select("edic_cd");
            $this->db->from("Edicao_Revisor");
            $this->db->join('Edicao', 'Edicao_Revisor.edre_edic_cd = Edicao.edic_cd','left');
            $this->db->join('Regra', 'Edicao.edic_regr_cd = Regra.regr_cd','left');
            $this->db->where('Regra.regr_revi_abert <=', $dataAtual);
            $this->db->where('Regra.regr_revi_encerr >=', $dataAtual);
            $this->db->where('Edicao_Revisor.edre_user_cd', $codigoRevisor);
            $this->db->where('Edicao_Revisor.edre_convite_status', 'Convite Aceito');
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result_object()[0]->edic_cd;
            }else{
                return null;
            }
        }

        public function excluir($obj) {
            $this->db->where('edic_cd', $obj->getCodigo());
            return $this->db->delete('edicao');
        }
            

}





