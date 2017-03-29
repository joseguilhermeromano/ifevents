<?php
if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class EmailModel extends CI_Model{

    public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/EmailDAO' );
            $this->load->Model( 'dao/UserDAO' );
            
    }

    public function criaLista($user_cd, $cadastro = true){
        $user = $this->session->userdata('usuario')[0]['user_tipo'];
        $user = empty($user) ? '0' : $user;
        $listaEmails = array();
        foreach($this->input->post('email') as $key=>$value){
            if(!empty($value)){
                $email = new EmailModel();
                if($key == 1 && $cadastro == false && $user !=3){
                    $data = $this->UserDAO->consultarCodigo($user_cd);
                    $email->email_email = $data['emails'][0];
                    $listaEmails[$key] = $email;
                }else{
                    $email->email_email = $value;
                }
                 isset($user_cd) ? $email->email_user_cd = $user_cd : '';
                if(($cadastro == false && $user==3) 
                    || $cadastro == true){
                    $key==0 ? $email->email_principal = 1 : $email->email_principal = 0;
                    $listaEmails[$key] = $email;
                }


                    //  $key==0 ? $email->email_principal = 1 : $email->email_principal = 0;
                    // $listaEmails[$key] = $email;
            }
        }	

        // echo print_r($listaEmails);
        return $listaEmails;
    }

    public function valida($cadastro = true){
        $user = $this->session->userdata('usuario')[0]['user_tipo'];
        $user = empty($user) ? '0' : $user;
        if($cadastro == true || ($cadastro == false && $user==3 && !empty($this->input->post('confirmaemail')))){
        	$this->form_validation->set_rules( 'email[0]', 'Email de Login', 'valid_email|trim|required|max_length[100]|differs[email[1]]|differs[email[2]]' );

            $this->form_validation->set_rules( 'confirmaemail', 'Confirma E-mail', 
                'valid_email|trim|required|max_length[100]|matches[email[0]]' );
        }
        $this->form_validation->set_rules( 'email[1]', 'E-mail alternativo 1', 'valid_email|trim|max_length[100]|differs[email[2]]|differs[emailLogin]' );

        $this->form_validation->set_rules( 'email[2]', 'E-mail alternativo 2', 'valid_email|trim|max_length[100]' );


    }


}

