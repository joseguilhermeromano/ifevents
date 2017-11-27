<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class InscricaoModel extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->Model( 'dao/InscricaoDAO' );
        }

        private $codigo;
        private $atividade;
        private $usuario;
        private $status;

        
        public function getCodigo(){
            return $this->codigo;
        }
        
        public function getAtividade(){
            return $this->atividade;
        }
        
        public function getUsuario(){
            return $this->usuario;
        }
        
        public function getStatus(){
            return $this->status;
        }
        
        
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
        
        public function setAtividade($atividade){
            $this->atividade = $atividade;
        }
        
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        
        public function setStatus($status){
            $this->status = $status;
        }

    }
