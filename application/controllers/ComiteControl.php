<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';

class ComiteControl extends PrincipalControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/ComiteDAO' );
			$this->load->Model('ComiteModel','comite');
		}

        public function cadastrar() {
            if (empty($this->comite->input->post())){
                $this->chamaView("novo-comite", "organizador",
                    array("title"=>"IFEvents - Novo Comitê"), 1);
                return true;
            }
            if( $this->comite->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->comite->setaValores();
                if($this->ComiteDAO->inserir($this->comite)==true){
                    $this->session->set_flashdata('success', 'O Comitê foi cadastrado com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível cadastrar o comitê!');
                }

            }
            $this->chamaView("novo-comite", "organizador",
                    array("title"=>"IFEvents - Novo Comitê"), 1);
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