<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ComiteControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/ComiteDAO' );
			$this->load->Model('ComiteModel','comite');
		}

        public function cadastrar() {
            if (empty($this->comite->input->post())){
                $this->chamaView("novo-comite", "organizador",
                    array("title"=>"IFEvents - Novo Comitê"), 1);
                return 0;
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

        public function alterar($codigo) {
        }
        public function consultar() {
        }

        public function consultarParaSelect2(){
            $data = $this->ComiteDAO->consultarTudo(array('comi_nm' => $this->comite->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function excluir($codigo) {

        }


}