<?php

class AvaliadorControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();

                    $this->load->helper('url');
                    $this->load->model('SubmitModel');
                    
            }
            
            public function index(){
                $this->load->view("common/header_interno");
                $this->load->view("avaliador/index");
                $this->load->view("common/footer_interno");
            }
            
            public function meuperfil(){
                $this->load->view("common/header_interno");
                $this->load->view("avaliador/meuperfil");
                $this->load->view("common/footer_interno");
            }
            
            
            public function submissoes(){
                $this->load->view("common/header_interno");
                $this->load->view("avaliador/submissoes");
                $this->load->view("common/footer_interno");
            }
            
    }

