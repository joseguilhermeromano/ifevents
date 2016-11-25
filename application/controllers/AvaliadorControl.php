<?php

class AvaliadorControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();
                    /*Validação de login deve ficar por aqui!!!!*/
                    
                    /* Carregamento de Helpers */
                    $this->load->helper('url');
                    
                    /*Carregamento de Models*/
                    $this->load->model('UsuarioModel');
//                    $this->load->model('ConferenciaModel'); 
//                    $this->load->model('EdicaoModel');
                    $this->load->model('ComiteModel');
//                    $this->load->model('ParceriaModel');
//                    $this->load->model('RegraModel');
//                    $this->load->model('EnderecoModel');
//                    $this->load->model('ModalidadeTematicaModel');
//                    $this->load->model('ArtigoModel');
//                    $this->load->model('SubmissaoModel');
//                    $this->load->model('AvaliacaoModel'); 
                    $this->load->model('ContatoModel');
                     
            }
            
            public function index(){

                    $this->load->view("common/header_interno");
                    $this->load->view("avaliador/index");
                    $this->load->view("common/footer_interno");

            }
            
            //Método para chamar qualquer view, dando a possibilidade de passar array de dados ou objetos
            public function view($view, $data=null){
                if ( ! file_exists(APPPATH.'/views/organizador/'.$view.'.php'))
                {
                        // Caso não exista a págiina, retorna o erro abaixo
                        show_404();
                }

                $this->load->view("common/header_interno");
                $this->load->view("organizador/".$view, $data);
                $this->load->view("common/footer_interno");
            }
            
            /*************************************************
             * Métodos Relacionados ao perfil do Organizador**
             *************************************************/
            public function exibePerfil(){
                
            }
            
            public function atualizaPerfil(){
                
            }
            
            public function alteraSenha(){
                
            }
            
            /***********************************************
             * Métodos Relacionados aos Artigos atribuídos**
             ***********************************************/
            
            public function listaTodosArtigos(){
                
            }
            
            public function listaArtigosAtivos(){
                
            }
            
            /***********************************************
             * Métodos Relacionados a submissão de artigos**
             ***********************************************/
            
            public function historicoSubmissao(){
                
            }
            
            public function cadastraAvaliacao(){
                
            }
            
            public function alteraAvaliacao(){
                
            }
            
            public function excluiAvaliacao(){
                
            }
            
            /**********************************************************
             * Métodos Relacionados a cadastro de mensagem de contato**
             **********************************************************/
            
            public function cadastraContato(){
                
            }
            
//            public function meuperfil(){
//                $this->load->view("common/header_interno");
//                $this->load->view("avaliador/meuperfil");
//                $this->load->view("common/footer_interno");
//            }
//            
//            //Método realiza consulta na tabela artigo e envia dados para avaliador
//            public function submissoes(){
//                $dados = array(
//                'result' => $this->SubmitDAO->Consulta()
//            );
//            
//            $this->load->view("common/header_interno");
//            $this->load->view("avaliador/submissoes", $dados);
//            $this->load->view("common/footer_interno");
//                
//            }
//
//             //Método realiza consulta na tabela artigo e envia dados para historico do avaliador
//            public function historico(){
//                $dados = array(
//                'result' => $this->SubmitDAO->Consulta()
//            );
//            
//            $this->load->view("common/header_interno");
//            $this->load->view("avaliador/historico-submissao", $dados);
//            $this->load->view("common/footer_interno");
//                
//            }
//            
//            public function feedback(){
//                $this->load->view("common/header_interno");
//                $this->load->view("avaliador/feedback");
//                $this->load->view("common/footer_interno");
//            }
//            
//            public function contato(){
//                $this->load->view("common/header_interno");
//                $this->load->view("common/contato");
//                $this->load->view("common/footer_interno");
//            }
            
    }

