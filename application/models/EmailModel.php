<?php
if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class EmailModel extends CI_Model{

    public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/EmailDAO' );
            $this->load->Model( 'dao/UsuarioDAO' );
            
    }

    public function setaValores($cadastro = true){
        $user = $this->session->userdata('usuario')[0]['user_tipo'];
        $user = empty($user) ? '0' : $user;
        if($cadastro == true || ($cadastro == false && $user==3 && !empty($this->input->post('confirmaemail')))){
            $this->email_email = $this->input->post("email");
        }
    }

    public function valida($cadastro = true){
        $user = $this->session->userdata('usuario')[0]['user_tipo'];
        $user = empty($user) ? '0' : $user;
        if($cadastro == true || ($cadastro == false && $user==3 && !empty($this->input->post('confirmaemail')))){
        	$this->form_validation->set_rules( 'email', 'E-mail', 'valid_email|trim|required|max_length[100]' );

            if($this->input->post('confirmaemail')){
                $this->form_validation->set_rules( 'confirmaemail', 'Confirma E-mail', 
                    'valid_email|trim|required|max_length[100]|matches[email]' );
            }
        }

    }


}

