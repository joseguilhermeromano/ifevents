<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class SubmissaoDAO extends CI_Model implements DAO{

    function SubmissaoDAO(){
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('SubmissaoModel', 'submissao');
        $this->load->model('dao/ArtigoDAO');
        $this->load->model('dao/AvaliacaoDAO');
    }

    public function inserir($obj) {
        return $this->db->insert('submissao', $this->obtemValores($obj));
    }

    public function alterar($obj) {
        $this->db->where('subm_cd', $obj->getCodigo());
        return $this->db->update('submissao', $this->obtemValores($obj));
    }
    
    private function obtemValores($obj){
        return array(
            'subm_cd' => $obj->getCodigo()
            ,'subm_versao' => $obj->getVersao()
            ,'subm_arq1_nm' => $obj->getNomeArqSemIdent()
            ,'subm_arq1' => $obj->getArqSemIdent()
            ,'subm_arq2_nm' => $obj->getNomeArqComIdent()
            ,'subm_arq2' => $obj->getArqComIdent()
            ,'subm_dt' => $obj->getData()
            ,'subm_hr' => $obj->getHora()
            ,'subm_arti_cd' => $obj->getArtigo()->getCodigo()
        );
    }

    public function consultarTudo($parametros = null, $limite=null,
        $numPagina=null, $sort=null, $ordenacao='desc') {
        $this->db->select("*");
        $this->db->from("Submissao");
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
            $resultado = $query->result_object();
            $array = array();
            foreach($resultado as $item){
                array_push($array, $item);
            }
            return $array;
        }else{
            return null;
        }
    }
    
    
    private function setaValores($consulta){
        $submissao = new $this->submissao;
        $submissao->setCodigo($consulta->subm_cd);
        $artigo = $this->ArtigoDAO->consultarCodigo($consulta->subm_arti_cd);
        $submissao->setArtigo($artigo);
        $submissao->setVersao($consulta->subm_versao);
        $submissao->setData(desconverteDataMysql($consulta->subm_dt));
        $submissao->setHora($consulta->subm_hr);
        $submissao->setNomeArqSemIdent($consulta->subm_arq1_nm);
        $submissao->setNomeArqComIdent($consulta->subm_arq2_nm);
        $submissao->setArqSemIdent($consulta->subm_arq1);
        $submissao->setArqComIdent($consulta->subm_arq2);
        $avaliacao = $this->AvaliacaoDAO->consultarPorCodigoSubmissao($consulta->subm_cd);
        $submissao->setAvaliacao($avaliacao);
        return $submissao;
    }

    public function consultarCodigo($codigo){
        $this->db->select('Submissao.*, Avaliacao.aval_cd');
        $this->db->from('Submissao');
        $this->db->join('Avaliacao', 'Submissao.subm_cd = Avaliacao.aval_subm_cd','left');
        $this->db->where('subm_cd', $codigo);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $consulta = $query->result_object()[0];
            return $this->setaValores($consulta);
        }
            return null;     
    }
    
    public function consultarUltimaSubmissao($codigoArtigo){
        $this->db->select('Submissao.*, Avaliacao.aval_cd');
        $this->db->from('Submissao');
        $this->db->join('Avaliacao', 'Submissao.subm_cd = Avaliacao.aval_subm_cd','left');
        $this->db->where('subm_arti_cd', $codigoArtigo);
        $this->db->order_by('subm_cd', 'desc');
        $query = $this->db->get();
        if($query->num_rows()>0){
            $consulta = $query->result_object()[0];
            return $this->setaValores($consulta);
        }else{
            return null;
        } 
    }

    public function consultarPorArtigo($codigo){
        $this->db->select('Submissao.*, Avaliacao.aval_cd');
        $this->db->from('Submissao');
        $this->db->join('Avaliacao', 'Submissao.subm_cd = Avaliacao.aval_subm_cd','left');
        $this->db->where('subm_arti_cd', $codigo);
        $query = $this->db->get();
        $submissoes = array();
        if($query->num_rows()>0){
            $consulta = $query->result_object();
            foreach($consulta as $row){
                $submissao = $this->setaValores($row);
                array_push($submissoes, $submissao);
                unset($submissao);
            }
            return $submissoes;
        }else{
            return null;
        } 
    }

    public function totalRegistros($artigo_cd){
         $query=$this->db->get_where('submissao',array('subm_arti_cd' => $artigo_cd));
         return $query->num_rows();
    }

    public function excluir($obj) {
        $this->db->where('subm_id', $obj->subm_id);
        return $this->db->delete('submissao');
    }

}    	




      
