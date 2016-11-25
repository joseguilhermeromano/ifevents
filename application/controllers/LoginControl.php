<?php

class LoginControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();
                    
                    /* Carregamento de Helpers */
                    $this->load->helper('url');
                    
                    /*Carregamento de Models*/
                    $this->load->model('UsuarioModel');
                     
            }
            
            //Tela de Login
            public function index(){

                    $this->load->view("common/header_interno");
                    $this->load->view("inicio/login");
                    $this->load->view("common/footer_interno");

            }
            
            public function login(){
                
            }
            
            public function logout(){
                
            }
            
            public function esqueceuSenha(){
                
            }
            
            
            
    }

