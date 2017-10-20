<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
class SubmissaoModel extends CI_Model{
    
    private $codigo;
    private $artigo;
    private $versao;
    private $data;
    private $hora;
    private $nomeArqComIdent;
    private $nomeArqSemIdent;
    private $arqComIdent;
    private $arqSemIdent;
    private $avaliacao;
    
    public function getCodigo(){
        return $this->codigo;
    }
    
    public function getArtigo(){
        return $this->artigo;
    }
    
    public function getVersao(){
        return $this->versao;
    }
    
    public function getData(){
        return $this->data;
    }
    
    public function getHora(){
        return $this->hora;
    }
    
    public function getNomeArqComIdent(){
        return $this->nomeArqComIdent;
    }
    
    public function getNomeArqSemIdent(){
        return $this->nomeArqSemIdent;
    }
    
    public function getArqComIdent(){
        return $this->arqComIdent;
    }
    
    public function getArqSemIdent(){
        return $this->arqSemIdent;
    }
    
    public function getAvaliacao(){
        return $this->avaliacao;
    }
    
    
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function setArtigo($artigo){
        $this->artigo = $artigo;
    }
    
    public function setVersao($versao){
        $this->versao = $versao;
    }
    
    public function setData($data){
        $this->data = $data;
    }
    
    public function setHora($hora){
        $this->hora = $hora;
    }
    
    public function setNomeArqComIdent($nomeArqComIdent){
        $this->nomeArqComIdent = $nomeArqComIdent;
    }
    
    public function setNomeArqSemIdent($nomeArqSemIdent){
        $this->nomeArqSemIdent = $nomeArqSemIdent;
    }
    
    public function setArqComIdent($arqComIdent){
        $this->arqComIdent = $arqComIdent;
    }
    
    public function setArqSemIdent($arqSemIdent){
        $this->arqSemIdent = $arqSemIdent;
    }
    
    public function setAvaliacao($avaliacao){
        $this->avaliacao = $avaliacao;
    }
        
                        
}										 			

