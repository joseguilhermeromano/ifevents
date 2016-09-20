<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

    class OrganizadorControl extends CI_Controller{
            /*Método construtor faz o carregamento de vários componentes
            necessários ao funcionamento do sistema*/

            public function __construct(){
                    parent::__construct();

                    $this->load->helper('url');
                    
            }
            
            public function index(){
                $this->load->view("common/header_interno");
                $this->load->view("organizador/index");
                $this->load->view("common/footer_interno");
            }
            
    }

