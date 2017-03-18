<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ArtigoControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/ArtigoDAO' );
			$this->load->Model('ArtigoModel','artigo');
            $this->load->Model( 'dao/SubmitDAO' );
            $this->load->Model('SubmitModel','submissao');
		}

        public function cadastrar() {
            if (empty($this->artigo->input->post())){
                $this->chamaView("novoartigo", "participante",
                    array("title"=>"IFEvents - Novo Artigo - Participante"), 1);
                return 0;
            }
            if( $this->artigo->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->artigo->setaValores();
                if($this->ArtigoDAO->inserir($this->artigo)==true){
                    $this->submissao->subm_arti_cod=$this->ArtigoDAO->ultimoId();
                    $this->submeterArtigo();
                }else{
                    $this->session->set_flashdata('error', 'O Artigo não foi cadastrado!');
                }

            }
            $this->chamaView("novoartigo", "participante",
                    array("title"=>"IFEvents - Novo Artigo - Participante"), 1);
        }

        private function submeterArtigo(){
            if($this->upload_arquivo($this->submissao)!=null){
                $this->submissao->setaValores();
                if($this->SubmitDAO->inserir($this->submissao)==true){
                    $this->session->set_flashdata( 'success', 'A Submissão foi realizada com sucesso!' );
                }else{
                    $this->session->set_flashdata( 'error', 'Não foi possível realizar a submissão!' );
                }
            }else{
                $this->session->set_flashdata( 'error', 'O arquivo não foi selecionado!' );
            }
        }

        public function historicoSubmissao(){
            $data['result']=$this->ArtigoModel->buscar();
            $data['submissoes']=$this->SubmitModel->buscarPorArtigo(); 
            $data['title'] = "IFEvents - Histórico de Submissões - Participante";
            $this->chamaView("historico-submissao", "participante", $data, 1);
        }

            public function alterar() {
            }

            public function consultar() {
                return $this->ArtigoDAO->consultarCodigo($this->input->get('codigo'));
            }

            public function consultarTudo() {
                $data['itens'] = $this->ArtigoDAO->consultarTudo();
                $data['title'] = "IFEvents - Meus Artigos - Participante";
                $this->chamaView("meusartigos", "participante", $data, 1);
            }

            public function excluir() {
            }


}