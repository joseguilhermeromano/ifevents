<?php
if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class TelefoneModel extends CI_Model{

    public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/TelefoneDAO' );
            
    }

    public $tele_cd;
    public $tele_fone;

    public function setaValores(){
        $this->tele_fone = $this->input->post('telefone');
    }


    public function valida(){
    	$this->form_validation->set_rules( 'telefone', 'Telefone/Celular', 
        'valid_phone' );

    }


}

