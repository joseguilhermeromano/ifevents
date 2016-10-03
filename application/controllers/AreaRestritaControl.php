<?php
//Este controlador representa a area interna dos usuarios do sistema
//Posteriormente os controladores ParticipanteControl, AvaliadorControl e OrganizadorControl
//serão substituidos por este
class AreaRestritaControl extends CI_Controller{
    
    public function __construct(){
            parent::__construct();

            $this->load->helper('url');

    }
    
    public function participante($page="index"){
        if ( ! file_exists(APPPATH.'/views/participante/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }

            $this->load->view("common/header_interno");
            $this->load->view("participante/".$page);
            $this->load->view("common/footer_interno");
    }
    
    public function avaliador($page="index"){
         if ( ! file_exists(APPPATH.'/views/avaliador/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }

            $this->load->view("common/header_interno");
            $this->load->view("avaliador/".$page);
            $this->load->view("common/footer_interno");
    }
    
    public function organizador($page="index"){
         if ( ! file_exists(APPPATH.'/views/organizador/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }

            $this->load->view("common/header_interno");
            $this->load->view("organizador/".$page);
            $this->load->view("common/footer_interno");
    }
   
}

