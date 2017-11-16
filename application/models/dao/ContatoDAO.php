<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

        include_once 'DAO.php';// Chamar sempre a interface por esta forma!

        class ContatoDAO extends CI_Model implements DAO{

                public function __construct(){
                        parent::__construct('ContatoDAO');

                }

                public function inserir($obj) {
                    return  $this->db->insert('Contato', $this->obtemValores($obj));
                }
                
                private function obtemValores($obj){
                    return array(
                         'cont_nm' => $obj->getNome()
                        ,'cont_email' => $obj->getEmail()
                        ,'cont_assunto' => $obj->getAssunto()
                        ,'cont_msg' => $obj->getMensagem()
                    );
                }

                public function alterar($obj) {
                    $this->db->where('cont_id', $obj->cont_id);
                    return $this->db->update('contato', $obj);
                }

                public function consultarTudo($parametros = null
                    , $limite=null, $numPagina=null, $sort='cont_nm', $ordenacao='asc') {
                    $this->db->select('cont_cd, cont_nm, cont_assunto, cont_email, cont_msg, cont_status');
                    $this->db->from('Contato');
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
                    }
                        return null;
                }

                public function consultarCodigo($codigo){                    
                    $this->db->where('cont_cd', $codigo);
                    $query = $this->db->get('Contato');
                    if($query->num_rows() > 0){
                        $consulta =  $query->result_object()[0];
                        $this->contato->setCodigo($consulta->cont_cd);
                        $this->contato->setNome($consulta->cont_nm);
                        $this->contato->setEmail($consulta->cont_email);
                        $this->contato->setAssunto($consulta->cont_assunto);
                        $this->contato->setMensagem($consulta->cont_msg);
                        $this->contato->setStatus($consulta->cont_status);
                        return $this->contato;
                    }
                        return null;
                }

                public function excluir($obj) {
                    $this->db->where('cont_cd', $obj);
                    return $this->db->delete('Contato');
                }

                public function insertResposta($codigo){
                    return  $this->db->insert('Resposta', $codigo);
                }
                
                public function totalRegistros(){
                    return $this->db->count_all("Contato");
                }
                
                public function totalNaoRespondidos(){
                    $this->db->where('cont_status',0);
                    return $this->db->count_all("Contato");
                }

}
