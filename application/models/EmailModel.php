<?php
if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class EmailModel extends CI_Model{

    public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/TelefoneDAO' );
            
    }
    public listaEmails = new array();

    public function setaValores(){
    	
    }

    public function valida(){
    	$this->form_validation
        ->set_rules( 'email[0]', 'Email de Login', 'valid_email|trim|required|max_length[100]|differs[email[1]]|differs[email[2]]' );

        $this->form_validation
        ->set_rules( 'confirmaemail', 'Confirma E-mail', 
            'valid_email|trim|required|max_length[100]|matches[emailLogin]' );

        $this->form_validation
        ->set_rules( 'email[1]', 'E-mail alternativo 1', 'valid_email|trim|max_length[100]|differs[email[2]]|differs[emailLogin]' );

        $this->form_validation
        ->set_rules( 'email[2]', 'E-mail alternativo 2', 'valid_email|trim|max_length[100]' );
    }


}

