<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class InstituicaoModel extends CI_Model{

      public function __construct(){
        parent::__construct();
          $this->load->Model( 'dao/InstituicaoDAO' );
      }

      private $codigo;
      private $nome;
      private $abreviacao;
      private $descricao;

      public function getCodigo(){
        return $this->codigo;
      }

      public function getNome(){
        return $this->nome;
      }

      public function getAbreviacao(){
        return $this->abreviacao;
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

      public function setAbreviacao($abreviacao){
        $this->abreviacao = $abreviacao;
      }

      public function setDescricao($descricao){
        $this->descricao = $descricao;
      }

      public function valida(){
    	    $this->form_validation->set_rules(	'nome', 'Nome', 'trim|required|max_length[100]' );
          $this->form_validation->set_rules(	'abreviacao', 'Abreviacao', 'trim|required|max_length[10]' );
    	    $this->form_validation->set_rules(	'descricao', 'Descricao', 'trim|required|max_length[500]' );
    		  return $this->form_validation->run();
      }

      public function setaValores(){
        $this->inst_cd   = $this->getCodigo();
        $this->inst_nm   = $this->getNome();
    		$this->inst_desc = $this->getDescricao();
        $this->inst_abrev = $this->getAbreviacao();
      }
    }
