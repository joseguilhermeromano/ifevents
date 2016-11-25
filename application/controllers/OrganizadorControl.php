<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

    class OrganizadorControl extends CI_Controller{
        
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();
                    //Validação de login deve ficar por aqui!!!!
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
            
            //Função para retornar uma instancia de Model
            public function carregaModel($nomeModel=null){
                 return $nomeModel==null ? null : $this->load->model(uppercase($nomeModel).'Model');
            }
            
            /***********************************
             * Métodos relacionados a Usuários**
             ***********************************/
            
            public function listaUsuario(){
                
            }
            
            public function buscaUsuario(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraUsuario(){
                
            }
            
            public function alteraUsuario(){
                
            }
            
            public function excluiUsuario(){
                
            }
            
            
            /***************************************
             * Métodos relacionados a Conferências**
             ***************************************/
            
            public function listaConferencia(){
                
            }
            
            public function buscaConferencia(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraConferencia(){
                $this->OrganizaModel->verifica();
            }
            
            public function alteraConferencia(){
                
            }
            
            public function excluiConferencia(){
                
            }
            
            /**********************************
             * Métodos relacionados a Comitês**
             **********************************/
            
            public function listaComite(){
                
            }
            
            public function buscaComite(){
                
            }
            
            public function cadastraComite(){
//                $this->ComiteModel->verifica();
                $this->ComiteModel->cadastrar();
            }
            
            public function alteraComite(){
                
            }
            
            public function excluiComite(){
                
            }
            
            /************************************
             * Métodos relacionados a Parcerias**
             ************************************/
            
            public function listaParceria(){
                
            }
            
            public function buscaParceria(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraParceria(){
                
            }
            
            public function alteraParceria(){
                
            }
            
            public function excluiParceria(){
                
            }
            
            /************************************
             * Métodos relacionados a Edição**
             ************************************/
            
            public function listaEdicao(){
                
            }
            
            public function buscaEdicao(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraEdicao(){
                
            }
            
            public function alteraEdicao(){
                
            }
            
            public function excluiEdicao(){
                
            }
            
            /******************************************
             * Métodos relacionados a Eixos Temáticos**
             ******************************************/
            
            public function listaEixo(){
                
            }
            
            public function buscaEixo(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraEixo(){
                
            }
            
            public function alteraEixo(){
                
            }
            
            public function excluiEixo(){
                
            }
            
            /***************************************************
             * Métodos relacionados a Modalidades de submissão**
             ***************************************************/
            
            public function listaModalidade(){
                
            }
            
            public function buscaModalidade(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraModalidade(){
                
            }
            
            public function alteraModalidade(){
                
            }
            
            public function excluiModalidade(){
                
            }
            
            /********************************************
             * Métodos relacionados a Regras de Eventos**
             ********************************************/
            
            public function listaRegra(){
                
            }
            
            public function buscaRegra(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraRegra(){
                
            }
            
            public function alteraRegra(){
                
            }
            
            public function excluiRegra(){
                
            }
            
            /************************************************
             * Métodos relacionados a Registro de Endereços**
             ************************************************/
            
            public function listaEndereco(){
                
            }
            
            public function buscaEndereco(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function cadastraEndereco(){
                
            }
            
            public function alteraEndereco(){
                
            }
            
            public function excluiEndereco(){
                
            }
            
            /***********************************
             * Métodos relacionados a Contatos**
             ***********************************/
            
            public function listaContato(){
                
            }
            
            public function buscaContato(){
                
            }
            
            //Método chama método verifica no model organiza model
            public function respondeContato(){
                
            }
            
            public function alteraResposta(){
                
            }
            
            public function excluiResposta(){
                
            }
            
            
//            public function submissoes(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/submissoes");
//                $this->load->view("common/footer_interno");
//            }
//            
//            public function avaliadores(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/avaliadores");
//                $this->load->view("common/footer_interno");
//            }
//            
//            //Método chama o formulário para cadastro de conferência
//            public function conferencias(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/conferencias");
//                $this->load->view("common/footer_interno");                
//            }
//
//            
//
//            //Método chama o formulário para cadastro de comitê
//            public function comite(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/comite");
//                $this->load->view("common/footer_interno");                 
//            }
//
//            
//            
//            public function contatos(){
//                $this->load->view("common/header_interno");
//                $this->load->view("common/contato");
//                $this->load->view("common/footer_interno");
//            }
//            
//            public function meuperfil(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/meuperfil");
//                $this->load->view("common/footer_interno");
//            }
//            
//            public function novaconferencia(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/novaconferencia");
//                $this->load->view("common/footer_interno");
//            }
//            
//            public function participantes(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/participantes");
//                $this->load->view("common/footer_interno");
//            }
//            
//            public function respondercontato(){
//                $this->load->view("common/header_interno");
//                $this->load->view("organizador/respondercontato");
//                $this->load->view("common/footer_interno");    
//            }
    }

