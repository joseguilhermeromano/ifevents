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
                    $this->load->model('UserModel');
                    $this->load->model('ArtigoModel');
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
                $this->chamaView('index');
            }
            
            //Método para chamar qualquer view, dando a possibilidade de passar array de dados ou objetos
            public function chamaView($view,$data=null,$caminho='participante/'){
                if ( ! file_exists(APPPATH.'/views/'.$caminho.$view.'.php'))
                {
                        // Caso não exista a págiina, retorna o erro abaixo
                        show_404();
                }

                $this->load->view("common/header_interno");
                $this->load->view($caminho.$view, $data);
                $this->load->view("common/footer_interno");
            }
            
            /**************************************************
             * Métodos Relacionados ao perfil do Participante**
             **************************************************/
            
            public function exibePerfil(){
                $this->chamaView('meuperfil');
            }
            
            public function atualizaPerfil(){
                
            }
            
            public function alteraSenha(){
                
            }
            
            /**********************************************
             * Métodos Relacionados ao registro do Artigo**
             **********************************************/
            
            public function cadastraArtigo(){
                if(!empty($this->input->get())||!empty($this->input->post())){
                    $dados=$this->ArtigoModel->cadastrar();
                }
                $this->chamaView('novoartigo');
            }
            
            public function alteraArtigo(){
                
            }
            
            public function excluiArtigo(){
                
            }
            
            public function buscaArtigo(){
                
            }
            
            public function listaTodosArtigos(){
                $this->chamaView('meusartigos',$this->ArtigoModel->buscarTudo());
            }
            
            public function listaArtigosAtivos(){
                
            }
            
            /***********************************************
             * Métodos Relacionados a submissão de artigos**
             ***********************************************/
            
            public function historicoSubmissao(){
                $this->chamaView('historico-submissao',$this->ArtigoModel->buscar(),'usuario/');
            }
            
            public function novaSubmissao(){
                
            }
            
            public function excluiSubmissao(){
                
            }
            
            /**********************************************************
             * Métodos Relacionados a cadastro de mensagem de contato**
             **********************************************************/
            
            public function cadastraContato(){
                $this->chamaView('contato',null,'usuario/');
            }
            
            public function sair(){
                
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
