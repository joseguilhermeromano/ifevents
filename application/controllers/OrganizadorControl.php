<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

    class OrganizadorControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();

                    $this->load->helper('url');
                    $this->load->model('OrganizaModel');
                    $this->load->model('ComiteModel');                                                        
            }


            //Método chama a página principal do organizador do evento.
            public function index(){
//                if(!$this->Auth->CheckAuth($this->router->fetch_class(), $this->router->fetch_method()){
                    $this->load->view("common/header_interno");
                    $this->load->view("organizador/index");
                    $this->load->view("common/footer_interno");
//                }
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
            
            //Método chama o formulário para cadastro de conferência
            public function conferencias(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/conferencias");
                $this->load->view("common/footer_interno");                
            }

            //Método chama método verifica no model organiza model
            public function cadastraConferencia(){
                $this->OrganizaModel->verifica();
            }

            //Método chama o formulário para cadastro de comitê
            public function comite(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/comite");
                $this->load->view("common/footer_interno");                 
            }

            //Método chama método verifica no model organiza model
            public function cadastraComite(){
                $this->ComiteModel->verifica();
            }
            
            public function contatos(){
                $this->load->view("common/header_interno");
                $this->load->view("common/contato");
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

