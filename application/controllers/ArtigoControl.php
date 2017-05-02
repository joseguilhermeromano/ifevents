<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ArtigoControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/ArtigoDAO' );
			$this->load->Model('ArtigoModel','artigo');
            $this->load->Model('ModalidadeTematicaModel', 'modalidadeTematica');
            $this->load->Model('dao/ModalidadeTematicaDAO');
            $this->load->Model( 'dao/SubmitDAO' );
            $this->load->Model('SubmitModel','submissao');
		}

        public function cadastrar() {
            $conf_cd = 1;
            $modalidades = $this->ModalidadeTematicaDAO->consultarTudo(array('mote_conf_cd'=>$conf_cd, 'mote_tipo'=> 0));
            $eixosTematicos = $this->ModalidadeTematicaDAO->consultarTudo(array('mote_conf_cd'=>$conf_cd, 'mote_tipo'=> 1));
            if (empty($this->artigo->input->post())){
                $this->chamaView("novoartigo", "participante",
                    array("title"=>"IFEvents - Novo Trabalho ", "modalidades" => $modalidades, "eixos" => $eixosTematicos), 1);
                return 0;
            }
            $this->artigo->valida();
            $this->artigo->setaValores();

            if($this->form_validation->run()){

                $config['upload_path']   = 'upload';
                $config['allowed_types'] = 'pdf|docx';
                $config['max_size']      =  4096;
                $lista_files = array();
                $files = $_FILES;

                for($i=0; $i<count($files['userfile']['name']); $i++)
                {
                    $_FILES = array();
                    foreach( $files['userfile'] as $k=>$v )
                    {
                        $_FILES['userfile'][$k] = $v[$i];                
                    }

                    $lista_files[$i] = $this->upload_arquivo($config);
                }

                $this->artigo->arti_arq_1 = isset($lista_files[0]) ? $lista_files[0] : NULL;
                $this->artigo->arti_arq_2 = isset($lista_files[1]) ? $lista_files[1] : NULL;


                $this->db->trans_start();
                    // $this->ArtigoDAO->inserir($this->artigo);
                    // $this->submissao->subm_arti_cod=1;
                    // $this->submeterArtigo();
                $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O seu trabalho foi submetido com sucesso!');
                    $this->artigo = null;
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível submeter o seu trabalho!');
                }
                

            }

            $this->chamaView("novoartigo", "participante",
                    array("title"=>"IFEvents - Novo Artigo - Participante","modalidades" => $modalidades, "eixos" => $eixosTematicos, "artigo" => $this->artigo), 1);
        }

        public function listarAtribuicoes(){
            $this->chamaView("atribuicoes-submissoes", "organizador",
                    array("title"=>"IFEvents - Atribuição de Submissões"), 1);
        }

        public function atribuirArtigo(){

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

            public function alterar($codigo) {
            }

            public function consultar() {
                $data['itens'] = $this->ArtigoDAO->consultarTudo();
                $data['title'] = "IFEvents - Meus Artigos - Participante";
                $this->chamaView("meusartigos", "participante", $data, 1);
            }

            public function consultarTudo() {
               
            }

            public function excluir($codigo) {
            }


}