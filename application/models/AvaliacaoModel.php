<?php
if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class AvaliacaoModel extends CI_Model{

    private $codigo;
    private $parecer;
    private $data;
    private $hora; 
    private $status;
    private $revisor;
    
    public function getCodigo(){
        return $this->codigo;
    }
    
    public function getParecer(){
        return $this->parecer;
    }
    
    public function getData(){
        return $this->data;
    }
    
    public function getHora(){
        return $this->hora;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function getRevisor(){
        return $this->revisor;
    }
    
    public function getSubmissao(){
        return $this->submissao;
    }
    
    
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function setParecer($parecer){
        $this->parecer = $parecer;
    }
    
    public function setData($data){
        $this->data = $data;
    }
    
    public function setHora($hora){
        $this->hora = $hora;
    }
    
    public function setStatus($status){
        $this->status = $status;
    }
    
    public function setRevisor($revisor){
        $this->revisor = $revisor;
    }
}

