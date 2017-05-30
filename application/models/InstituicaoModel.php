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

    }