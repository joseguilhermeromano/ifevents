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
                    
                    /* VALIDAÇÃO DE LOGIN */
                    
                    $usuario=$this->session->userdata('usuario');
                    if($usuario[0]!=null){
                        if($usuario[0]['user_tipo']!=0){
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
            public function chamaView($view, $data=null, $caminho='participante/'){
                if ( ! file_exists(APPPATH.'/views/'.$caminho.$view.'.php'))
                {
                        // Caso não exista a págiina, retorna o erro abaixo
                        show_404();
                }

                $this->load->view("common/area-interna/header");
                $this->load->view($caminho.$view, $data);
                $this->load->view("common/area-interna/footer");
            }
            
            /**************************************************
             * Métodos Relacionados ao perfil do Participante**
             **************************************************/
            
            public function exibePerfil(){
                $this->chamaView('meuperfil',null,'usuario/');
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
                $data['result']=$this->ArtigoModel->buscar();
                $data['submissoes']=$this->SubmitModel->buscarPorArtigo(); 
                $this->chamaView('historico-submissao',$data,'usuario/');
            }
            
            public function downloadArtigo(){
                $this->SubmitModel->download_arquivo();
            }
            
            public function novaSubmissao(){
                
            }
            
            public function excluiSubmissao(){
                
            }
            
            /**********************************************************
             * Métodos Relacionados a cadastro de mensagem de contato**
             **********************************************************/
            
            public function cadastraContato(){
                if(!empty($this->input->get())||!empty($this->input->post())){
                    $this->ContatoModel->cadastrar();
                }
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
