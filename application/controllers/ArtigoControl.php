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
            $this->load->Model('SubmitModel','submissao');
            $this->load->Model('dao/SubmitDAO');
            $this->load->Model('dao/EdicaoDAO');
		}

        public function cadastrar() {
            $conf_cd = $this->uri->segment(3);
            if($conf_cd == '' || $conf_cd === null){
                $this->session->set_flashdata('error', 'Não foi selecionado nenhum evento que apresente submissões abertas!');
                redirect('artigo/consultar');
            }
            $modalidades = $this->ModalidadeTematicaDAO->consultarTudo(array('mote_conf_cd'=>$conf_cd, 'mote_tipo'=> 0));
            $eixosTematicos = $this->ModalidadeTematicaDAO->consultarTudo(array('mote_conf_cd'=>$conf_cd, 'mote_tipo'=> 1));
            $data = array("title"=>"IFEvents - Novo Trabalho"
                ,"modalidades" => $modalidades
                ,"eixos" => $eixosTematicos);

            if (empty($this->artigo->input->post())){
                return $this->chamaView("novoartigo", "participante", $data, 1);
            }

            $this->artigo->valida();
            $this->artigo->setaValores();

            if($this->form_validation->run()){
                $data['artigo'] = $this->artigo;

                $config['upload_path']   = 'upload';
                $config['allowed_types'] = 'pdf|docx';
                $config['max_size']      =  4096;

                $file_1 = $this->upload_arquivo($config, 'file_artigo_1');
                $file_2 = $this->upload_arquivo($config, 'file_artigo_2');


                if($file_1['error'] == true){
                    $this->session->set_flashdata('error', 'O Trabalho sem identificação não pode ser enviado!<br>
                        Verifique se o arquivo foi selecionado corretamente e se sua permissão é uma das permitidas!');
                    return $this->chamaView("novoartigo", "participante", $data, 1);
                }

                if($file_2['error'] == true){
                   $this->session->set_flashdata('error', 'O Trabalho identificado não pode ser enviado!<br>
                        Verifique se o arquivo foi selecionado corretamente e se sua permissão é uma das permitidas!');
                    return $this->chamaView("novoartigo", "participante", $data, 1);
                }


                $this->db->trans_start();
                    $artigo_cd =  $this->ArtigoDAO->inserir($this->artigo);
                    $this->submissao->setaValores($file_1, $file_2, $artigo_cd);
                    $this->SubmitDAO->inserir($this->submissao);
                $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O seu trabalho foi submetido com sucesso!');
                    $data['artigo'] = null;
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível submeter o seu trabalho!');
                }


            }


            return $this->chamaView("novoartigo", "participante", $data, 1);
        }

        public function alterar($codigo) {
            $artigo = $this->ArtigoDAO->consultarCodigo($codigo);
            $artigo->aceite_subm_checked = 1;
            $modalidades = $this->ModalidadeTematicaDAO->consultarTudo(array('mote_conf_cd'=>$artigo->mote_conf_cd,
                'mote_tipo'=> 0));
            $eixosTematicos = $this->ModalidadeTematicaDAO->consultarTudo(array('mote_conf_cd'=>$artigo->mote_conf_cd,
             'mote_tipo'=> 1));
            $data = array("title"=>"IFEvents - Novo Trabalho"
                ,"modalidades" => $modalidades
                ,"eixos" => $eixosTematicos
                ,"artigo" => $artigo);

            if (empty($this->artigo->input->post())){
                return $this->chamaView("novoartigo", "participante", $data, 1);
            }

            $this->artigo->valida();
            $this->artigo->setaValores();

            if($this->form_validation->run()){
                $data['artigo'] = $this->artigo;

                $config['upload_path']   = 'upload';
                $config['allowed_types'] = 'pdf|docx';
                $config['max_size']      =  4096;

                $file_1 = $this->upload_arquivo($config, 'file_artigo_1');
                $file_2 = $this->upload_arquivo($config, 'file_artigo_2');


                if($file_1['error'] == true){
                    $this->session->set_flashdata('error', 'O Trabalho sem identificação não pode ser enviado!<br>
                        Verifique se o arquivo foi selecionado corretamente e se sua permissão é uma das permitidas!');
                    return $this->chamaView("novoartigo", "participante", $data, 1);
                }

                if($file_2['error'] == true){
                   $this->session->set_flashdata('error', 'O Trabalho identificado não pode ser enviado!<br>
                        Verifique se o arquivo foi selecionado corretamente e se sua permissão é uma das permitidas!');
                    return $this->chamaView("novoartigo", "participante", $data, 1);
                }


                $this->db->trans_start();
                    $artigo_cd =  $this->ArtigoDAO->inserir($this->artigo);
                    $this->submissao->setaValores($file_1, $file_2, $artigo_cd);
                    $this->SubmitDAO->inserir($this->submissao);
                $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O seu trabalho foi submetido com sucesso!');
                    $data['artigo'] = null;
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível submeter o seu trabalho!');
                }


            }


            return $this->chamaView("novoartigo", "participante", $data, 1);
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

        public function detalharTrabalho($codigo){
            $artigo=$this->ArtigoDAO->consultarCodigo($codigo);
            $artigo->eixo = $this->ModalidadeTematicaDAO->consultarCodigo($artigo->arti_eite_cd)->mote_nm;
            $artigo->modalidade = $this->ModalidadeTematicaDAO->consultarCodigo($artigo->arti_moda_cd)->mote_nm;
            $data['artigo'] = $artigo;
            $data['submissoes']=$this->SubmitDAO->consultarPorArtigo($codigo);
            $data['title'] = "IFEvents - Detalhes do Trabalho";
            $this->chamaView("historico-submissao", "usuario", $data, 1);
        }

        public function downloadArtigo($numArq, $submissao_cd){
            $submissao = $this->SubmitDAO->consultarCodigo($submissao_cd);
            if($numArq <= 1){
                return $this->download_arquivo($submissao->subm_arq1_nm,$submissao->subm_arq1);
            }else{
                return $this->download_arquivo($submissao->subm_arq2_nm,$submissao->subm_arq2);
            }
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

            public function submissaoEventosRecentes(){
                $data['eventos'] = $this->EdicaoDAO->consultarPorDataSubmissao(date('Y-m-d'));
                if(empty($data['eventos'])){
                    $this->session->set_flashdata("warning","Não há eventos com submissões abertas no momento!");
                    redirect('artigo/consultar');
                }
                $data['title']="IFEvents - Submissão de Trabalhos - Eventos Recentes";
                $this->chamaView("eventos-recentes", "participante", $data, 1);
            }

            public function excluir($codigo) {
            }


}
