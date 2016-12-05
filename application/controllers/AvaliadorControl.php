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
                    $this->load->model('UserModel');
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
                    
                    /* VALIDAÇÃO DE LOGIN */
                    
                    $usuario=$this->session->userdata('usuario');
                    if($usuario[0]!=null){
                        if($usuario[0]['user_tipo']!=1){
                            $this->session->set_flashdata("error","Você não tem permissão para acessar esta página!");
                            redirect('login');
                        }
                    }else{
                        $this->session->set_flashdata("error","Você não está logado!");
                        redirect('login');
                    }
                     
            }
            
            public function index(){
                $this->chamaView('index');
            }
            
            //Método para chamar qualquer view, dando a possibilidade de passar array de dados ou objetos
            private function chamaView($view, $data=null,$caminho='avaliador/'){
                if ( ! file_exists(APPPATH.'/views/'.$caminho.$view.'.php'))
                {
                        // Caso não exista a págiina, retorna o erro abaixo
                        show_404();
                }

                $this->load->view("common/header_interno");
                $this->load->view($caminho.$view, $data);
                $this->load->view("common/footer_interno");
            }
            
            /*************************************************
             * Métodos Relacionados ao perfil do Organizador**
             *************************************************/
            public function exibePerfil(){
                $this->chamaView('meuperfil',null,'usuario/');
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
                $this->chamaView('submissoes');
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
                $this->chamaView('contato',null,'usuario/');
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

