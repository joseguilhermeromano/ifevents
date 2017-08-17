<?php
	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

	class ArtigoDAO extends CI_Model implements DAO{

		public function __construct(){
                    parent::__construct();
                    $this->load->model('dao/ModalidadeTematicaDAO');
                    $this->load->model('ArtigoModel', 'artigo');
		}
                
                private function obtemValores($obj){
                    return array('arti_title' => $obj->getTitulo()
                    ,'arti_autores' => $obj->getAutores()
                    ,'arti_orienta' => $obj->getOrientador()
                    ,'arti_resumo' => $obj->getResumo()
                    ,'arti_status' => $obj->getStatus()
                    ,'arti_moda_cd' => $obj->getModalidade()->moda_cd
                    ,'arti_eite_cd' => $obj->getEixoTematico()->eite_cd);
                }

                public function inserir($obj) {
                    $autores = $obj->getAutores();
                    $autorResp = $obj->getCodigoAutorResponsavel();
                    $obj->setAutores($this->obtemStringAutores($autores));
                    $this->db->insert('Artigo', $this->obtemValores($obj));
                    $codigoArtigo = $this->db->insert_id();
                    $this->vinculaAutores($codigoArtigo, $autores, $autorResp);
                    return $codigoArtigo;
                }

                public function alterar($obj) {
                    $autores = $obj->getAutores();
                    $autorResp = $obj->getCodigoAutorResponsavel();
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

                public function consultarTudo($parametros = null, $limite=null,
                        $numPagina=null, $sort='arti_title', $ordenacao='asc') {
                    $this->db->select("Artigo.*, Autoria.autor_respons, Conferencia.conf_abrev,"
                            . "Edicao.edic_num");
                    $this->db->from("Artigo");
                    $this->db->join('Autoria', 'Artigo.arti_cd = Autoria.auto_arti_cd','left');
                    $this->db->join('Modalidade_Tematica', 'Artigo.arti_moda_cd = Modalidade_Tematica.mote_cd','left');
                    $this->db->join('Edicao', 'Modalidade_Tematica.mote_edic_cd= Edicao.edic_cd','left');
                    $this->db->join('Conferencia', 'Edicao.edic_conf_cd = Conferencia.conf_cd','left');
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

                public function totalRegistros(){
                    return $this->db->count_all("Artigo");
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
                        $this->artigo->setCodigoAutorResponsavel($consulta->auto_user_cd);

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
