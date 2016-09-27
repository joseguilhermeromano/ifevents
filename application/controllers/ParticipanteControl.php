<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

    class ParticipanteControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();

                    $this->load->helper('url');
                    $this->load->model('SubmitModel');
                    
            }
            
            public function index(){
                $this->load->view("common/header_interno");
                $this->load->view("participante/index");
                $this->load->view("common/footer_interno");
            }
            
            public function meuperfil(){
                $this->load->view("common/header_interno");
                $this->load->view("participante/meuperfil");
                $this->load->view("common/footer_interno");
            }
            
            public function novoartigo(){
                $this->load->view("common/header_interno");
                $this->load->view("participante/novoartigo");
                $this->load->view("common/footer_interno");
            }
            
            public function meusartigos(){
                $this->load->view("common/header_interno");
                $this->load->view("participante/meusartigos");
                $this->load->view("common/footer_interno");
            }
            
            public function contato(){
                $this->load->view("common/header_interno");
                $this->load->view("participante/contato");
                $this->load->view("common/footer_interno");
            }
            
            public function sair(){
                
            }
    }
