<?php if ( !defined( 'BASEPATH')) exit( 'No direct script access allowed');
    require_once 'DAO.php';
class TipoAtividadeDAO extends CI_Model implements DAO{

    public function __construct(){
      parent::__construct();
      $this->load->model('TipoAtividadeModel', 'tipoAtividade');
    }

    private function obtemValores($obj){
        return array('tiat_cd' => $obj->getCodigo()
                ,'tiat_nm' => $obj->getTitulo()
                ,'tiat_desc' => $obj->getDescricao());
    }

    public function inserir($obj) {
      return $this->db->insert( 'Tipo_atividade', $this->obtemValores($obj));
    }

    public function alterar($obj) {
      $this->db->where('tiat_cd', $obj->getCodigo());
      return $this->db->update('Tipo_atividade', $this->obtemValores($obj));
    }

    public function consultarTudo($parametros = null, $limite=null, $numPagina=null, $sort='tiat_nm', $ordenacao='asc') {
      $this->db->select("tiat_cd, tiat_nm, tiat_desc");
      $this->db->from("Tipo_atividade");
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
      $this->db->where('tiat_cd', $codigo);
      $query = $this->db->get('Tipo_atividade');
      if($query->num_rows() > 0){
        $consulta = $query->result_object()[0];
        $this->tipoAtividade->setCodigo($consulta->tiat_cd);
        $this->tipoAtividade->setTitulo($consulta->tiat_nm);
        $this->tipoAtividade->setDescricao($consulta->tiat_desc);
        return $this->tipoAtividade;
      }
        return false;
    }

    public function excluir($obj) {
      $this->db->where('tiat_cd', $obj);
      return $this->db->delete('Tipo_atividade');
    }
  
    public function totalRegistros(){
        return $this->db->count_all("Tipo_atividade");
    }
}
