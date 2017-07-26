<?php
if( !defined("BASEPATH")) exit('No direct script access allowed');

class ComiteModel extends CI_Model{

    private $codigo;
    private $nome;
    private $descricao;
    
    public function getCodigo(){
        return $this->codigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }
    
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

}
