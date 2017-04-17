<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ConferenciaControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/ConferenciaDAO' );
			$this->load->Model('ConferenciaModel','conferencia');
		}

        public function cadastrar() {
        }

        public function alterar($codigo) {
        }
        public function consultar() {
        }

        public function consultarParaSelect2(){
            $data = $this->ConferenciaDAO->consultarTudo(array('conf_nm' => $this->conferencia->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function excluir($codigo) {

        }


}