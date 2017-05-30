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

            $data['title'] = "IFEvents - Instituicao - Organizador";

            if (empty($this->instituicao->input->post())){
                $this->chamaView("novainstituicao", "organizador", $data,  1);
                return true;
            }

            if( $this->instituicao->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->instituicao->setaValores();
                if($this->InstituicaoDAO->inserir($this->instituicao)==true){
                    $this->session->set_flashdata('success', 'Instituição cadastrada com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Instituição não cadastrada!');
                }

            }

            $this->chamaView("novainstituicao", "organizador", $data,  1 );
        }

        public function alterar($codigo) {
			$data['instituicao'] = $this->InstituicaoDAO->consultarCodigo($codigo);
			$data['title'] = "IFEvents - Instituicao - organizador" ;
            if(!empty($this->input->post())){
				$this->chamaView("edita-instituicao", "organizador", $data, 1);
                $this->instituicao->setaValores();
                $this->instituicao->inst_cd = $this->uri->segment(3);
                 if( $this->instituicao->valida()==false){
                         $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
                 }
                else{
                     if($this->InstituicaoDAO->alterar($this->instituicao)==true){
                         $this->session->set_flashdata('success', 'O Instituição atualizada com sucesso!');
                         redirect('instituicao/consultarTudo/');

                     }else{
                         $this->session->set_flashdata('error', 'Não foi possível atualizar a instituição!');
                     }

                 }

            }

            $this->chamaView("edita-instituicao", "organizador", $data, 1);

		}

        public function consultarParaSelect2(){
            $data = $this->InstituicaoDAO->consultarPorNomeOuAbreviacao($this->instituicao->input->post('term'));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        public function consultar() {

        }

		public function consultarTudo(){
			$data['flag'] = $this->uri->segment(3);
			$data['content'] = $this->InstituicaoDAO->consultarTudo();
			$data['title'] = "IFEvents - Instituicao - Organizador";
			$this->chamaView("listainstituicao", "organizador", $data, 1);
		}


        public function excluir($codigo) {
			if( $this->InstituicaoDAO->excluir($this->uri->segment(3)) == false){
					$this->session->set_flashdata('error', 'Instituicao não pode ser excluida!');
			}
		   else{
					$this->session->set_flashdata('success', 'Instituição deletada com sucesso!');
					redirect('instituicao/consultarTudo/');
				}
        }


}
