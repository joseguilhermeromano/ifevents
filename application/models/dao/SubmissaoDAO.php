<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class SubmissaoDAO extends CI_Model implements DAO{

    function SubmitDAO(){
            parent::__construct();
            $this->load->library('upload');
            $this->load->model('SubmissaoModel');
            $this->load->model('dao/ArtigoDAO');
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
        $this->submissao->setCodigo($consulta->subm_cd);
        $artigo = $this->ArtigoDAO->consultarCodigo($consulta->subm_arti_cd);
        $this->submissao->setArtigo($artigo);
        $this->submissao->setVersao($consulta->subm_versao);
        $this->submissao->setData(desconverteDataMysql($consulta->subm_dt));
        $this->submissao->setHora($consulta->subm_hr);
        $this->submissao->setNomeArqSemIdent($consulta->subm_arq1_nm);
        $this->submissao->setNomeArqComIdent($consulta->subm_arq2_nm);
        $this->submissao->setArqSemIdent($consulta->subm_arq1);
        $this->submissao->setArqComIdent($consulta->subm_arq2);
        return $this->submissao;
    }

    public function consultarCodigo($codigo){
        $this->db->select('*');
        $this->db->from('Submissao');
        $this->db->where('subm_cd', $codigo);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $consulta = $query->result_object()[0];
            return $this->setaValores($consulta);
        }
            return null;     
    }
    
    public function consultarUltimaSubmissao($codigoArtigo){
        $this->db->select('*');
        $this->db->from('Submissao');
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
        $query=$this->db->get_where('submissao',array('subm_arti_cd' => $codigo));
         return $query->result_object();
    }

    public function totalRegistros($artigo_cd){
         $query=$this->db->get_where('submissao',array('subm_arti_cd' => $artigo_cd));
         return $query->free_result();
    }

    public function excluir($obj) {
        $this->db->where('subm_id', $obj->subm_id);
        return $this->db->delete('submissao');
    }

}    	




      
