<?php
    if ( !defined( 'BASEPATH')) exit( 'No direct script access allowed');

    class TipoAtividadeModel extends CI_Model{

        public function __construct(){
            parent::__construct();

            $this->load->model('dao/TipoAtividadeDAO');
        }
        private $codigo;
        private $titulo;
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

        public function getDescricao(){
          return $this->descricao;
        }

        public function setDescricao($descricao){
          $this->descricao = $descricao;
        }
    }
