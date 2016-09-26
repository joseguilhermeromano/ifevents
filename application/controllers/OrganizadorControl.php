<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

    class OrganizadorControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();

                    $this->load->helper('url');
                    
            }
            
            public function index(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/index");
                $this->load->view("common/footer_interno");
            }
            
            public function submissoes(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/submissoes");
                $this->load->view("common/footer_interno");
            }
            
            public function avaliadores(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/avaliadores");
                $this->load->view("common/footer_interno");
            }
            
            public function conferencias(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/conferencias");
                $this->load->view("common/footer_interno");
            }
            
            public function contatos(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/contatos");
                $this->load->view("common/footer_interno");
            }
            
            public function meuperfil(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/meuperfil");
                $this->load->view("common/footer_interno");
            }
            
            public function novaconferencia(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/novaconferencia");
                $this->load->view("common/footer_interno");
            }
            
            public function participantes(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/participantes");
                $this->load->view("common/footer_interno");
            }
            
            public function respondercontato(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/respondercontato");
                $this->load->view("common/footer_interno");    
            }
    }

