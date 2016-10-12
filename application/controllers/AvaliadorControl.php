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
            
            //Método realiza consulta na tabela artigo e envia dados para avaliador
            public function submissoes(){
                $dados = array(
                'result' => $this->SubmitDAO->Consulta()
            );
            
            $this->load->view("common/header_interno");
            $this->load->view("avaliador/submissoes", $dados);
            $this->load->view("common/footer_interno");
                
            }

             //Método realiza consulta na tabela artigo e envia dados para historico do avaliador
            public function historico(){
                $dados = array(
                'result' => $this->SubmitDAO->Consulta()
            );
            
            $this->load->view("common/header_interno");
            $this->load->view("avaliador/historico-submissao", $dados);
            $this->load->view("common/footer_interno");
                
            }
            
            public function feedback(){
                $this->load->view("common/header_interno");
                $this->load->view("avaliador/feedback");
                $this->load->view("common/footer_interno");
            }
            
            public function contato(){
                $this->load->view("common/header_interno");
                $this->load->view("common/contato");
                $this->load->view("common/footer_interno");
            }
            
    }

