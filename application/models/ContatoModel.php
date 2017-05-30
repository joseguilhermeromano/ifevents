<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class ContatoModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('dao/ContatoDAO');
	}

        public function valida(){
			$this->form_validation->set_rules( 'tipo_notificacao', 'Notificar', 'trim|required|max_length[11]' );
            if($notificacao->tipo_notificacao == 1){
                $this->form_validation->set_rules( 'emails[]', 'Emails', 'valid_emails|trim|required|max_length[100]' );
            }
            $this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
    		$this->form_validation->set_rules( 'email', 'E-mail', 'trim|required|max_length[80]' );
    		$this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );
    		$this->form_validation->set_rules( 'mensagem', 'Mensagem', 'trim|required|max_length[500]' );
            return $this->form_validation->run();
        }

        public function setaValores(){
            $this->cont_nm      = $this->input->post( 'nome' );
			$this->cont_assunto = $this->input->post('assunto');
			$this->cont_email   = $this->input->post( 'email' );
			$this->cont_msg     = $this->input->post( 'mensagem' );
        }


}
