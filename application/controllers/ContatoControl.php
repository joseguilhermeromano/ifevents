<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';

class ContatoControl extends PrincipalControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/ContatoDAO' );
			$this->load->Model('ContatoModel','contato');
		}

        public function cadastrar() {
            if (empty($this->contato->input->post())){
                $this->chamaView("contato", "usuario",
                    array("title"=>"IFEvents - Novo Contato"), 1);
                return true;
            }
            if( $this->contato->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->contato->setaValores();
                if($this->ContatoDAO->inserir($this->contato)==true){
                    $this->session->set_flashdata('success', 'O Contato foi enviado com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível enviar a mensagem de contato!');
                }

            }
            $this->chamaView("contato", "usuario",
                    array("title"=>"IFEvents - Novo Contato"), 1);
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