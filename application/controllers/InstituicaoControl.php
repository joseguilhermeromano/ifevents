<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class InstituicaoControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/InstituicaoDAO' );
			$this->load->Model('InstituicaoModel','instituicao');
		}

        public function cadastrar() {
        }



        public function alterar($codigo) {
        }

        public function consultarParaSelect2(){
            $data = $this->InstituicaoDAO->consultarPorNome($this->instituicao->input->post('term'));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function consultarTudo() {
        }

        public function excluir() {

        }


}