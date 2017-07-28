<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');
    	include_once 'DAO.php';// Chamar sempre a interface por esta forma!
	class InscricaoDAO extends CI_Model implements DAO{

		public function __construct(){
			parent::__construct();
		}

        public function inserir($obj) {
        	return $this->db->insert('Inscricao', $obj);
        }

        public function ultimoId(){
        	return $this->db->insert_id();
        }

        public function alterar($obj) {
			$this->db->where('ativ_cd', $obj->ativ_cd);
			$this->db->set('ativ_nm', $obj->ativ_nm);
			$this->db->set('ativ_desc', $obj->ativ_desc);
			$this->db->set('ativ_responsavel', $obj->ativ_responsavel);
			$this->db->set('ativ_dt', $obj->ativ_dt);
			$this->db->set('ativ_hora_ini', $obj->ativ_hora_ini);
			$this->db->set('ativ_hora_fin', $obj->ativ_hora_fin);
			$this->db->set('ativ_local', $obj->ativ_local);
			$this->db->set('ativ_vagas_qtd', $obj->ativ_vagas_qtd);
			$this->db->set('ativ_tiat_cd', $obj->ativ_tiat_cd);
		    return $this->db->update('Atividade', $obj);
        }

        public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort=null, $ordenacao='asc') {
        	$this->db->select("insc_cd, insc_ativ_cd, insc_user_cd");
            $this->db->from("Inscricao");
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

        public function consultarCodigo($codigo){
			$this->db->select('insc_status, insc_ativ_cd');
			$this->db->from('Inscricao');
			$this->db->where( 'insc_ativ_cd', $codigo );
			$query = $this->db->get();
			$query = $query->result_object();
			$inscricao = (object) array();
			$consulta = $query[0];
			$inscricao->insc_status = $consulta->insc_status;
			$inscricao->insc_ativ_cd = $consulta->insc_ativ_cd;
			return $inscricao;
		}

        public function excluir($obj) {
        	$this->db->where( 'insc_ativ_cd', $obj );
            return $this->db->delete( 'Inscricao' );
        }
	}
