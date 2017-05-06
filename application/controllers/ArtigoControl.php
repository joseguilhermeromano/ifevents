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

                $files = $this->upload_arquivo($config);


                $this->db->trans_start();
                    // $this->ArtigoDAO->inserir($this->artigo);
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
                $limite = 10;
                $numPagina =0;
                //pegar codigo da conferencia pela sessao 
                $conf_cd = 1;
                if(null !== $this->input->get('pagina')){
                    $numPagina = $this->input->get('pagina');
                }

                if( $this->input->get('busca') !== null){
                    $busca = $this->input->get('busca');
                    $array = array('Artigo.arti_title'=>$busca);
                }else{
                    $busca=null;
                    $array=null;
                }

                $data['itens']=$this->ArtigoDAO->consultarTudo($array, $limite, $numPagina);
                $data['paginacao'] = $this->geraPaginacao($limite, $this->ArtigoDAO->totalRegistros(), 'artigo/consultar/?busca='.$busca);
                $data['totalRegistros'] = $this->ArtigoDAO->totalRegistros();
                $data['title']="IFEvents - Meus Trabalhos";
                $this->chamaView("meusartigos", "participante", $data, 1);
            }

            public function consultarTudo() {
               
            }

            public function excluir($codigo) {
            }


}