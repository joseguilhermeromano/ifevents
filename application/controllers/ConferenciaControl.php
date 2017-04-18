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
            if (empty($this->conferencia->input->post())){
                $this->chamaView("novaconferencia", "organizador",
                    array("title"=>"IFEvents - Conferencia - Organizador"), 1);
                return 0;
            }
            if( $this->conferencia->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->conferencia->setaValores();
                if($this->ConferenciaDAO->inserir($this->conferencia)==true){
                    $this->session->set_flashdata('success', 'Conferência cadastrada com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Conferencia não cadastrada!');
                }

            }
            $this->chamaView("novaconferencia", "organizador",
                    array("title"=>"IFEvents - Conferencia - organizador"), 1);
        }

        public function listaconferencia(){
            $this->chamaView("listaconferencia", "organizador",
                    array("title"=>"IFEvents - Nova Conferencia - Organizador"), 1);
        }

		//Método altera dados cadastrados
        public function alterar($codigo) {
			$data['content'] = $this->ConferenciaDAO->consultarCodigo($this->uri->segment(3));
			$data['title']  = "IFEvents - Lista Conferencia - organizador";

			if(!empty($this->input->post())){
				$this->conferencia->setaValores();
				$this->conferencia->conf_cd = $this->uri->segment(3);
	             if( $this->conferencia->valida()==false){
	                     $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
	             }
	            else{
					//echo print_r($this->conferencia);
	                 if($this->ConferenciaDAO->alterar($this->conferencia)==true){
	                     $this->session->set_flashdata('success', 'O Usuário foi atualizado com sucesso!');
	                  	 redirect('conferencia/consultarTudo/');

	                 }else{
	                     $this->session->set_flashdata('error', 'Não foi possível atualizar o usuário!');
	                 }

	             }

			}

			$this->chamaView("formUpdate", "organizador", $data, 1);
        }

        public function consultar() {
            $data['content'] = $this->ConferenciaDAO->consultarCodigo($codigo);
			$data['title']  = "IFEvents - Lista Conferencia - organizador";
			$this->chamaView("formUpdate", "organizador", $data, 1);
        }

        public function consultarTudo() {
					$data['content'] = $this->ConferenciaDAO->consultarTudo();
					$data['title']  = "IFEvents - Lista Conferencia - organizador";

            		$this->chamaView("listaconferencia", "organizador", $data, 1);
        }


		public function excluir($codigo) {

			if( $this->ConferenciaDAO->excluir($this->uri->segment(3)) == false){
					$this->session->set_flashdata('error', 'Arquivo não pode ser excluido!');
			}
		   else{
					$this->session->set_flashdata('success', 'Arquivo deletado com sucesso!');
					redirect('conferencia/consultarTudo/');
				}

		}

        public function consultarParaSelect2(){
            $data = $this->ConferenciaDAO->consultarTudo(array('conf_nm' => $this->conferencia->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }


}
