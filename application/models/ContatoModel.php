<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
    include_once 'InterfaceModel.php';
class ContatoModel extends CI_Model implements InterfaceModel{

	public function __construct(){
		parent::__construct();
		$this->load->model('dao/ContatoDAO');
	}
        
        private function valida(){
            	$this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
		$this->form_validation->set_rules( 'email', 'E-mail', 'trim|required|max_length[80]' );
		$this->form_validation->set_rules( 'assunto', 'Assunto', 'trim|required|max_length[50]' );		
		$this->form_validation->set_rules( 'mensagem', 'Mensagem', 'trim|required|max_length[200]' );
                return $this->form_validation->run();
        }
        
        private function setaValores(){
            $this->cont_nm = $this->input->post( 'nome' );		
            $this->cont_email = $this->input->post( 'email' );
            $this->cont_assunto = $this->input->post( 'assunto' );
            $this->cont_mens = $this->input->post( 'mensagem' );
        }
        
        
        public function cadastrar() {
            $this->setaValores();
            if( $this->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                if($this->ContatoDAO->inserir($this)==true){
                    $this->session->set_flashdata('success', 'O Contato foi enviado com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível enviar a mensagem de contato!');
                }

            }
        }

        public function alterar() {
            return true;
        }

        public function buscar() {
            return null;
        }

        public function buscarTudo() {
            return null;
        }

        public function excluir() {
            return true;
        }
}