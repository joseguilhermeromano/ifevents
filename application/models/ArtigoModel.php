<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ArtigoModel extends CI_Model{

        private $codigo;
        private $titulo;
        private $autores;
        private $orientador;
        private $modalidade;
        private $eixoTematico;
        private $resumo;
        private $autorResponsavel;
        private $status;

        public function getCodigo(){
            return $this->codigo;
        }
        
        public function getCodigoAutorResponsavel(){
            return $this->autorResponsavel;
        }
        
        public function getTitulo(){
            return $this->titulo;
        }
        
        public function getAutores(){
            return $this->autores;
        }

        public function getOrientador(){
            return $this->orientador;
        }
        
        public function getModalidade(){
            return $this->modalidade;
        }
        
        public function getEixoTematico(){
            return $this->eixoTematico;
        }
        
        public function getResumo(){
            return $this->resumo;
        }
        
        public function getStatus(){
            return $this->status;
        }
       
        
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
        
        public function setCodigoAutorResponsavel($autorResponsavel){
            $this->autorResponsavel = $autorResponsavel;
        }
        
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }
        
        public function setAutores($autores){
            $this->autores = $autores;
        }

        public function setOrientador($orientador){
            $this->orientador = $orientador;
        }
        
        public function setModalidade($modalidade){
            $this->modalidade = $modalidade;
        }
        
        public function setEixoTematico($eixoTematico){
            $this->eixoTematico = $eixoTematico;
        }
        
        public function setResumo($resumo){
            $this->resumo = $resumo;
        }
        
        public function setStatus($status){
            $this->status = $status;
        }

    }

