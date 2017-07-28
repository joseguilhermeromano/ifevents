<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class InscricaoModel extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->Model( 'dao/InscricaoDAO' );
        }

        private $codigoInscricao;
        private $codigoAtividade;
        private $codigoUsuario;

        public function getCodigoInscricao(){
            return $this->codigoInscricao;
        }

        public function setCodigoInscricao($codigoInscricao){
            $this->codigoInscricao = $codigoInscricao;
        }

        public function getCodigoAtividade(){
            return $this->codigoAtividade;
        }

        public function setCodigoAtividade($codigoAtividade){
            $this->codigoAtividade = $codigoAtividade;
        }

        public function getCodigoUsuario(){
            return $this->codigoUsuario;
        }

        public function setCodigoUsuario($codigoUsuario){
            $this->codigoUsuario = $codigoUsuario;
        }

        public function setaValores(){
            $this->insc_cd      = $this->getCodigoInscricao();
    		$this->insc_ativ_cd = $this->getCodigoAtividade();
            $this->insc_user_cd = $this->getCodigoUsuario();
        }

    }
