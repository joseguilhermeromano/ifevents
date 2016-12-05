<?php

class LoginControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();
                    
                    /* Carregamento de Helpers */
                    $this->load->helper('url');
                    
                    /*Carregamento de Models*/
                    $this->load->model('UserModel');
                    $this->load->library("session");
                     
            }
            
            //Tela de Login
            //Método para chamar qualquer view, dando a possibilidade de passar array de dados ou objetos
            public function chamaView($view, $data=null,$caminho="organizador/"){
                if ( ! file_exists(APPPATH.'/views/'.$caminho.$view.'.php'))
                {
                        // Caso não exista a págiina, retorna o erro abaixo
                        show_404();
                }

                $this->load->view("common/header_interno");
                $this->load->view($caminho.$view, $data);
                $this->load->view("common/footer_interno");
            }
            
            public function entrar(){
                $usuario['usuario'] = $this->UserModel->login();
                if($usuario['usuario']!=null){
                    $this->session->set_userdata($usuario);
                        if($usuario->user_tipo == 2){
                            redirect('organizador/');
                        }
                        else if($usuario['tipo'] == 1){
                                redirect('avaliador');
                        }	
                        else{
                                redirect('participante');
                        }
                }else{
                    $this->session->set_flashdata("error","E-mail ou senha incorretos!");
                    redirect('login');
                }
            }
            
            public function sair(){
                $this->session->sess_destroy();
                redirect('index');
            }
            
            public function esqueceuSenha(){
                
            }
            
            
            
    }

