<?php
if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class TelefoneModel extends CI_Model{

    public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/TelefoneDAO' );
            
    }

    public function setaValores(){
    	
    }

    public function valida(){
    	$this->form_validation->set_rules( 'telefone[1]', 'Telefone/Celular 1', 
        'valid_phone|differs[telefone[2]]|differs[telefone[3]]' );
        $this->form_validation->set_rules( 'telefone[2]', 'Telefone/Celular 2', 'valid_phone' );
        $this->form_validation->set_rules( 'telefone[3]', 'Telefone/Celular 3', 'valid_phone' );
    }


}

