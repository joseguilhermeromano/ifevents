<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class AtividadeDAO extends CI_Model implements DAO{

				public function __construct(){
					parent::__construct();

				}

                public function inserir($obj) {
                    return $this->db->insert('Atividade', $obj);
                }

                public function ultimoId(){
                    return $this->db->insert_id();
                }

                public function alterar($obj) {
					$this->db->where('ativ_cd', $obj->ativ_cd);
					$this->db->set('ativ_nm', $obj->ativ_nm);
					$this->db->set('ativ_desc', $obj->ativ_desc);
					$this->db->set('ativ_dt', $obj->ativ_dt);
					$this->db->set('ativ_hora_ini', $obj->ativ_hora_ini);
					$this->db->set('ativ_hora_fin', $obj->ativ_hora_fin);
					$this->db->set('ativ_local', $obj->ativ_local);
					$this->db->set('ativ_vagas_qtd', $obj->ativ_vagas_qtd);
					$this->db->set('ativ_tiat_cd', $obj->ativ_tiat_cd);
		            return $this->db->update('Atividade', $obj);
                }
				
                public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='ativ_nm', $ordenacao='asc') {
                    $this->db->select("ativ_cd, ativ_nm, ativ_desc, ativ_dt, ativ_hora_ini, ativ_hora_fin, ativ_local, ativ_vagas_qtd, ativ_tiat_cd");
                    $this->db->from("Atividade");
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
					$this->db->where( 'ativ_cd', $codigo );
					$query = $this->db->get( 'Atividade' );
					if($query->num_rows() > 0){
						return $query->result_object();
					}
					else{
						return FALSE;
					}

                }

                public function excluir($obj) {
                    $this->db->where( 'ativ_cd', $obj );
                    return $this->db->delete( 'Atividade' );
                }

}
