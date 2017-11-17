<?php
if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class ArtigoDAO extends CI_Model implements DAO{

        public function __construct(){
            parent::__construct();
            $this->load->model('dao/ModalidadeTematicaDAO');
            $this->load->model('dao/UsuarioDAO');
            $this->load->model('ArtigoModel', 'artigo');
        }

        private function obtemValores($obj){
            return array('arti_title' => $obj->getTitulo()
            ,'arti_autores' => $obj->getAutores()
            ,'arti_orienta' => $obj->getOrientador()
            ,'arti_resumo' => $obj->getResumo()
            ,'arti_status' => $obj->getStatus()
            ,'arti_moda_cd' => $obj->getModalidade()->mote_cd
            ,'arti_eite_cd' => $obj->getEixoTematico()->mote_cd);
        }

        public function inserir($obj) {
            $autores = $obj->getAutores();
            $autorResp = $obj->getAutorResponsavel()->getCodigo();
            $obj->setAutores($this->obtemStringAutores($autores));
            $this->db->insert('Artigo', $this->obtemValores($obj));
            $codigoArtigo = $this->db->insert_id();
            $this->vinculaAutores($codigoArtigo, $autores, $autorResp);
            return $codigoArtigo;
        }

        public function alterar($obj) {
            $autores = $obj->getAutores();
            $autorResp = $obj->getAutorResponsavel()->getCodigo();
            $obj->setAutores($this->obtemStringAutores($autores));
            $this->db->where('arti_cd', $obj->getCodigo());
            $this->db->update('artigo', $this->obtemValores($obj));
            $this->vinculaAutores($obj->getCodigo(), $autores, $autorResp);
        }

        private function vinculaAutores($codigoAtigo, $autores, $autorResp){
            $this->db->where('auto_arti_cd', $codigoAtigo);
            $this->db->delete('Autoria');
            foreach ($autores as $key => $value) {
                $codigoUser = somenteNumeros($value);
                if($codigoUser){
                    $this->db->insert('Autoria'
                    ,array('auto_user_cd' => $codigoUser
                    ,'auto_arti_cd'=> $codigoAtigo
                    ,'autor_respons' 
                    => $codigoUser == $autorResp ? 1 : 0 ));
                }
            }
        }

        public function consultarResultadosFinais($parametros = null, $limite=null,
            $numPagina=null, $sort='arti_title', $ordenacao='asc') {
            $this->db->select("Artigo.arti_title, Artigo.arti_status, Artigo.arti_cd"
                    . ", mote1.mote_nm as modalidade, mote2.mote_nm as eixo");
            $this->db->from("Artigo");
            $this->db->join('Modalidade_Tematica mote1', 'Artigo.arti_moda_cd = mote1.mote_cd','left');
            $this->db->join('Modalidade_Tematica mote2', 'Artigo.arti_eite_cd = mote2.mote_cd','left');
            $this->db->join('Edicao', 'Modalidade_Tematica mote1.mote_edic_cd= Edicao.edic_cd','left');
            $this->db->order_by($sort, $ordenacao);
            if($parametros!==null){
                foreach ($parametros as $key => $value) {
                    $this->db->where($key.' LIKE ','%'.$value.'%');
                }
            }
            $this->db->where('arti_status LIKE ','%Aprovado%');
            $this->db->or_where('arti_status LIKE ','%Reprovado%');
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

        public function consultarTudo($parametros = null, $limite=null,
            $numPagina=null, $sort='arti_title', $ordenacao='asc') {
            $this->db->select("Artigo.*, Autoria.autor_respons, Conferencia.conf_abrev, Edicao.edic_num"
                    . ", mote1.mote_nm as modalidade, mote2.mote_nm as eixo");
            $this->db->from("Artigo");
            $this->db->join('Autoria', 'Artigo.arti_cd = Autoria.auto_arti_cd','left');
            $this->db->join('Modalidade_Tematica', 'Artigo.arti_moda_cd = Modalidade_Tematica.mote_cd','left');
            $this->db->join('Edicao', 'Modalidade_Tematica.mote_edic_cd= Edicao.edic_cd','left');
            $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd','left');
            $this->db->join('Modalidade_Tematica mote1', 'Artigo.arti_moda_cd = mote1.mote_cd','left');
            $this->db->join('Modalidade_Tematica mote2', 'Artigo.arti_eite_cd = mote2.mote_cd','left');
            $this->db->order_by($sort, $ordenacao);
            if($parametros!==null){
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

        public function totalTrabalhosAndamento($codigoAutor){
            $this->db->join('Autoria', 'Artigo.arti_cd = Autoria.auto_arti_cd','left');
            $this->db->where('auto_user_cd', $codigoAutor);
            $this->db->where('arti_status', 'Pronto para a revisão');
            $this->db->or_where('arti_status', 'Aguardando Revisão');
            return count($this->db->get("Artigo"));
        }

        public function totalTrabalhosFinalizadosAutor($codigoAutor){
            $this->db->join('Autoria', 'Artigo.arti_cd = Autoria.auto_arti_cd','left');
            $this->db->where('auto_user_cd', $codigoAutor);
            $this->db->where('autor_respons', 1);
            $this->db->where('arti_status', 'Aprovado');
            $this->db->or_where('arti_status', 'Reprovado');
            return count($this->db->get("Artigo"));
        }

        public function totalResultadosFinaisArtigos($codigoEdicao){
            return count($this->consultarResultadosFinais
                (array('edic_cd'=>$codigoEdicao)));
        }
        
        public function totalArtigosParticipante($codigoAutor){
            $parametros = array('auto_user_cd' => $codigoAutor);
            return count($this->consultarTudo($parametros));
        }

        public function totalArtigosPorEdicao($codigoEdicao){
            $this->db->join('Modalidade_Tematica', 'Artigo.arti_moda_cd = Modalidade_Tematica.mote_cd','left');
            $this->db->join('Edicao', 'Modalidade_Tematica.mote_edic_cd= Edicao.edic_cd','left');
            $this->db->where('mote_edic_cd', $codigoEdicao);
            return count($this->db->get("Artigo"));
        }

        public function consultarCodigo($codigo){
             $this->db->select("Artigo.*, Autoria.auto_user_cd");
             $this->db->from("Artigo");
             $this->db->join('Autoria', 'Artigo.arti_cd = Autoria.auto_arti_cd','left');
             $this->db->where('Artigo.arti_cd', $codigo);
             $this->db->where('Autoria.autor_respons', 1);
             $query       = $this->db->get();
            if($query->num_rows() > 0){
                $consulta       = $query->result_object()[0];

                $this->artigo->setCodigo($consulta->arti_cd);
                $this->artigo->setTitulo($consulta->arti_title);
                $this->artigo->setOrientador($consulta->arti_orienta);
                $autores = $this->obtemArrayAutores($consulta->arti_autores);
                $this->artigo->setAutores($autores);
                $this->artigo->setResumo($consulta->arti_resumo);
                $this->artigo->setStatus($consulta->arti_status);
                $eixo = $this->ModalidadeTematicaDAO
                        ->consultarCodigo($consulta->arti_eite_cd);
                $this->artigo->setEixoTematico($eixo);
                $modalidade = $this->ModalidadeTematicaDAO
                        ->consultarCodigo($consulta->arti_moda_cd);
                $this->artigo->setModalidade($modalidade);
                $autorResponsavel = $this->UsuarioDAO->consultarCodigo($consulta->auto_user_cd);
                $this->artigo->setAutorResponsavel($autorResponsavel);

                return $this->artigo;
            }

            return null;
        }

        private function obtemStringAutores($arrayAutores){
            natcasesort($arrayAutores);
            return implode(', ', $arrayAutores);
        }

        private function obtemArrayAutores($stringAutores){
            return explode(', ', $stringAutores);
        }


        public function excluir($obj) {
            $this->db->where('arti_id', $obj->arti_id);
            return $this->db->delete('artigo');
        }



}
