<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class ContatoModel extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->model('dao/ContatoDAO');
	}

        public function valida(){
            $this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
    		$this->form_validation->set_rules( 'email', 'E-mail', 'trim|required|max_length[80]' );
    		$this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );
    		$this->form_validation->set_rules( 'mensagem', 'Mensagem', 'trim|required|max_length[200]' );
            return $this->form_validation->run();
        }

        public function setaValores(){
            $this->email->from( 'projetoifsp2017@gmail.com');
			$this->email->to($this->input->post( 'email' ), $this->cont_email = $this->input->post( 'nome' ));
			$this->email->subject($this->input->post( 'assunto' ));
			$this->email->message($this->input->post( 'mensagem' ));
        }

}
