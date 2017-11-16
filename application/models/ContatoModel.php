<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class ContatoModel extends CI_Model{
        
    public function __construct(){
        parent::__construct();
        $this->load->model('dao/ContatoDAO');
    }
    
    private $codigo;
    private $nome;
    private $assunto;
    private $email;
    private $mensagem;
    private $status;
    
    public function getCodigo(){
        return $this->codigo;
    }
    
    public function getNome(){
        return $this->nome;
    }
    
    public function getAssunto(){
        return $this->assunto;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function getMensagem(){
        return $this->mensagem;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function setAssunto($assunto){
        $this->assunto = $assunto;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setMensagem($mensagem){
        $this->mensagem = $mensagem;
    }
    
    public function setStatus($status){
        $this->status = $status;
    }


}
