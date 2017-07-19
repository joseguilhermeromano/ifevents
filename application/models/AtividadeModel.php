<?php if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

  class AtividadeModel extends CI_Model{

    public function __construct(){
      parent::__construct();
      $this->load->Model( 'dao/AtividadeDAO' );
    }
    private $codigo;
    private $titulo;
    private $descricao;
    private $data;
    private $inicio;
    private $termino;
    private $local;
    private $quantidadeVagas;
    private $tipoAtividade;

    public function getCodigo(){
      return $this->codigo;
    }

    public function setCodigo($codigo){
      $this->codigo = $codigo;
    }

    public function getTitulo(){
      return $this->titulo;
    }

    public function setTitulo($titulo){
      $this->titulo = $titulo;
    }

    public function getDescricao(){
      return $this->descricao;
    }

    public function setDescricao($descricao){
      $this->descricao = $descricao;
    }

    public function getData(){
      return $this->data;
    }

    public function setData($data){
      $this->data = date("Y-m-d",strtotime(str_replace('/','-',$data)));
    }

    public function getInicio(){
      return $this->inicio;
    }

    public function setInicio($inicio){
      $this->inicio = $inicio;
    }

    public function getTermino(){
      return $this->termino;
    }

    public function setTermino($termino){
      $this->termino = $termino;
    }

    public function getLocal(){
      return $this->local;
    }

    public function setLocal($local){
      $this->local = $local;
    }

    public function getQuantidadeVagas(){
      return $this->quantidadeVagas;
    }

    public function setQuantidadeVagas($quantidadeVagas){
      $this->quantidadeVagas = $quantidadeVagas;
    }

    public function getTipoAtividade(){
      return $this->tipoAtividade;
    }

    public function setTipoAtividade($tipoAtividade){
      $this->tipoAtividade = $tipoAtividade;
    }

    public function setaValores(){
      $this->ativ_cd        = $this->getCodigo();
      $this->ativ_nm        = $this->getTitulo();
    	$this->ativ_desc      = $this->getDescricao();
      $this->ativ_dt        = $this->getData();
      $this->ativ_hora_ini  = $this->getInicio();
      $this->ativ_hora_fin  = $this->getTermino();
      $this->ativ_local     = $this->getLocal();
      $this->ativ_vagas_qtd = $this->getQuantidadeVagas();
      $this->ativ_tiat_cd   = $this->getTipoAtividade();
    }

}
