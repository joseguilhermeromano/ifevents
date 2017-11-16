<?php	if ( !defined("BASEPATH")) exit( 'No direct script access allowed');

	include_once 'DAO.php';// Chamar sempre a interface por esta forma!

class AtividadeDAO extends CI_Model implements DAO{

    public function __construct(){
            parent::__construct();

    }
    
    private function obtemValores($obj){
        return array('ativ_cd' => $obj->getCodigo()
                ,'ativ_nm' => $obj->getTitulo()
                ,'ativ_desc' => $obj->getDescricao()
                ,'ativ_responsavel' => $obj->getResponsavel()
                ,'ativ_dt' => $obj->getData()
                ,'ativ_hora_ini' => $obj->getInicio()
                ,'ativ_hora_fin' => $obj->getTermino()
                ,'ativ_local' => $obj->getLocal()
                ,'ativ_vagas_qtd' => $obj->getQuantidadeVagas()
                ,'ativ_tiat_cd' => $obj->getTipoAtividade()
                ,'ativ_edic_cd' => $obj->getCodigoEdicao());
    }

    public function inserir($obj) {
        return $this->db->insert('Atividade', $this->obtemValores($obj));
    }
    
    public function inscrever($codigoAtividade, $codigoUsuario){
        
        $orig_db_debug = $this->db->db_debug;
        
        $this->db->db_debug = FALSE;
         $parametros = array('insc_ativ_cd' => $codigoAtividade
        , 'insc_user_cd' => $codigoUsuario);
        $this->db->insert('Inscricao', $parametros);
        if($this->db->error()['code']==1062){
            throw new Exception('Você já está inscrito nesta atividade!');
        }

        $this->db->db_debug = $orig_db_debug;
    }
    
    public function cancelarInscricao($codigoAtividade, $codigoUsuario){
        $this->db->where( 'insc_ativ_cd',$codigoAtividade);
        $this->db->where( 'insc_user_cd',$codigoUsuario);
        return $this->db->delete( 'Inscricao' );
    }

    public function ultimoId(){
          return $this->db->insert_id();
    }

    public function alterar($obj) {
      $this->db->where('ativ_cd', $obj->getCodigo());
      return $this->db->update('Atividade', $this->obtemValores($obj));
    }

    public function consultarTudo($parametros = null, $limite=null, 
            $numPagina=null, $sort='ativ_nm', $ordenacao='asc') {
        $this->db->select("ativ_cd, ativ_nm, ativ_desc, ativ_responsavel, 
        ativ_dt, ativ_hora_ini, ativ_hora_fin, ativ_local, count(i.insc_cd) as vagas_ocupadas
        , ativ_vagas_qtd, ativ_tiat_cd, ativ_edic_cd, tiat_nm, edic_num, conf_abrev,"
        ."(CASE WEEKDAY(ativ_dt) 
        when 0 then 'Segunda-feira'
        when 1 then 'Terça-feira'
        when 2 then 'Quarta-feira'
        when 3 then 'Quinta-feira'
        when 4 then 'Sexta-feira'
        when 5 then 'Sábado'
        when 6 then 'Domingo'                 
        END) AS DiaDaSemana,");
        $this->db->from("Atividade");
        $this->db->join("Tipo_atividade","Atividade.ativ_tiat_cd = Tipo_atividade.tiat_cd", "left");
        $this->db->join("Edicao","Atividade.ativ_edic_cd = Edicao.edic_cd", "left");
        $this->db->join("Conferencia","Edicao.edic_conf_cd = Conferencia.conf_cd", "left");
        $this->db->join("Inscricao as i","Atividade.ativ_cd = i.insc_ativ_cd", "left");
        $this->db->order_by($sort, $ordenacao);
        if($parametros !== null){
              if(!empty($parametros['Conferencia.conf_abrev'])){
                $this->db->or_where('Conferencia.conf_abrev LIKE ','%'.$parametros['Conferencia.conf_abrev'].'%');
              }
              if(!empty($parametros['edic_num'])){
                $this->db->or_where('Edicao.edic_num',$parametros['edic_num']);
              }
              if(!empty($parametros['ativ_nm'])){
                $this->db->or_where('ativ_nm LIKE ','%'.$parametros['ativ_nm'].'%');
              }
        }
        if($limite){
            $this->db->limit($limite, $numPagina);
        }
        $query = $this->db->get();
        if($query->result_object()[0]->ativ_cd !== null){
            return $query->result_object();
        }
            return null;
    }

    public function consultarCodigo($codigo){
        $this->db->select('ativ_cd, ativ_nm, ativ_desc, ativ_responsavel, 
        ativ_dt, ativ_hora_ini, ativ_hora_fin,
        ativ_local, ativ_vagas_qtd, ativ_tiat_cd, ativ_edic_cd');
        $this->db->from('Atividade');
        $this->db->where( 'ativ_cd', $codigo );
        $query = $this->db->get();
        $query = $query->result_object();
        $atividade = (object) array();
        $consulta = $query[0];
        $atividade->ativ_cd = $consulta->ativ_cd;
        $atividade->ativ_nm = $consulta->ativ_nm;
        $atividade->ativ_desc = $consulta->ativ_desc;
        $atividade->ativ_responsavel = $consulta->ativ_responsavel;
        $atividade->ativ_dt = $consulta->ativ_dt;
        $atividade->ativ_hora_ini  = $consulta->ativ_hora_ini;
        $atividade->ativ_hora_fin  = $consulta->ativ_hora_fin;
        $atividade->ativ_local     = $consulta->ativ_local;
        $atividade->ativ_vagas_qtd = $consulta->ativ_vagas_qtd;
        $atividade->ativ_tiat_cd   = $consulta->ativ_tiat_cd;
        $atividade->ativ_edic_cd   = $consulta->ativ_edic_cd;
        return $atividade;
    }

    public function excluir($obj) {
        $this->db->where( 'ativ_cd', $obj );
        return $this->db->delete( 'Atividade' );
    }
  
    public function totalRegistros(){
        return $this->db->count_all("Atividade");
    }

}
