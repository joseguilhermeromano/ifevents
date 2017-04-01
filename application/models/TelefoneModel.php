<?php
if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class TelefoneModel extends CI_Model{

    public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/TelefoneDAO' );
            
    }

    public function setaValores(){
        $this->tele_fone = $this->input->post('telefone');
    }

    // public function criaLista($user_cd){
    //     $listaTelefones = array();
    //     if(null !== $this->input->post('telefone')){
    //         foreach($this->input->post('telefone') as $key=>$value){
    //              if(!empty($value)){
    //                 $tel = new TelefoneModel();
    //                 $tel->tele_fone = $value;
    //                 isset($user_cd) ? $tel->tele_user_cd = $user_cd : '';
    //                 $listaTelefones[$key] = $tel;
    //             }
    //         }  
    //     } 
    //     return $listaTelefones;
    // }

    public function valida(){
    	$this->form_validation->set_rules( 'telefone', 'Telefone/Celular', 
        'valid_phone' );
        // $this->form_validation->set_rules( 'telefone[2]', 'Telefone/Celular 2', 'valid_phone' );
        // $this->form_validation->set_rules( 'telefone[3]', 'Telefone/Celular 3', 'valid_phone' );

    }


}

