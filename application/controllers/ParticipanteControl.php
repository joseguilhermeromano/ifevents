<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

    class ParticipanteControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();
                    //Validação de login deve ficar por aqui!!!!
                    
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
                $this->load->view("participante/index");
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
            
            /**************************************************
             * Métodos Relacionados ao perfil do Participante**
             **************************************************/
            
            public function exibePerfil(){
                
            }
            
            public function atualizaPerfil(){
                
            }
            
            public function alteraSenha(){
                
            }
            
            /**********************************************
             * Métodos Relacionados ao registro do Artigo**
             **********************************************/
            
            public function cadastraArtigo(){                    
                    if($this->Autentica->Check( $this->router->fetch_class(), $this->router->fetch_method()) == true ){
                        $this->load->view("common/header_interno");
                        $this->load->view("participante/novoartigo");
                        $this->load->view("common/footer_interno");
                    } 
                //redirect('administracao/Home/login');   
            }
            
            public function alteraArtigo(){
                
            }
            
            public function excluiArtigo(){
                
            }
            
            public function buscaArtigo(){
                
            }
            
            public function listaTodosArtigos(){
                
            }
            
            public function listaArtigosAtivos(){
                
            }
            
            /***********************************************
             * Métodos Relacionados a submissão de artigos**
             ***********************************************/
            
            public function historicoSubmissao(){
                
            }
            
            public function novaSubmissao(){
                
            }
            
            public function excluiSubmissao(){
                
            }
            
            /**********************************************************
             * Métodos Relacionados a cadastro de mensagem de contato**
             **********************************************************/
            
            public function cadastraContato(){
                
            }
            
            
            
            
            
//            public function meusartigos(){
//                $this->load->view("common/header_interno");
//                $this->load->view("participante/meusartigos");
//                $this->load->view("common/footer_interno");
//            }
//            
//            public function contato(){
//                $this->load->view("common/header_interno");
//                $this->load->view("common/contato");
//                $this->load->view("common/footer_interno");
//            }
//
//            
//            public function sair(){
//                
//            }
    }
