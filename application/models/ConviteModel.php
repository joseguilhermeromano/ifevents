<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ConviteModel extends CI_Model{

        public function __construct(){
            parent::__construct();

            $this->load->library('email');
        }

        public function enviar(){
            //recebe os dados do formulario
            $data = $this->input->post();

            //Configuração para o envio de email
            $config['protocol'] = 'mail';
            $config['wordwrap'] = TRUE;
            $config['validate'] = TRUE;
            $config['mailtype'] = 'text';

            $this->email->initialize($config);

            $this->email->from('projetoifsp@gmail.com', 'Remetente');
            $this->email->to($data['email'], $data['nome']);
            $this->email->subject("Testando o envio de convite para o avaliador");
            $this->email->message($data['mensagem']);

            if(isset($dados['anexo']))
                $this->email->attach('./common/img/logoifevents.png');

           if($this->email->send()){
               $this->session->set_flashdata('success','Email enviado com sucesso!');
               redirect( 'OrganizadorControl/enviaConvite' );
           }
           else{
               $this->session->set_flashdata('error',$this->email->print_debugger());
               redirect( 'OrganizadorControl/enviaConvite' );
           }

        }


    }
