<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ConferenciaModel extends CI_Model{
        
      private $codigo;
      private $titulo;
      private $abreviacao;
      private $descricao;

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

      public function getAbreviacao(){
        return $this->abreviacao;
      }

      public function setAbreviacao($abreviacao){
        $this->abreviacao = $abreviacao;
      }

      public function getDescricao(){
        return $this->descricao;
      }

      public function setDescricao($descricao){
        $this->descricao = $descricao;
      }

    }
