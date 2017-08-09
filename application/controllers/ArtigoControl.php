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
        
        private function consultarModalidadesEixos(){
            $codigoEdicao = $this->uri->segment(3);
            if($codigoEdicao == ''){
                $this->session->set_flashdata('error', 'Não foi selecionado nenhum '
                        . 'evento que apresente submissões abertas!');
                redirect('artigo/consultar');
            }
            $edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
            $consulta = array('mote_conf_cd'=>$edicao->getConferencia()->getCodigo()
                    , 'mote_tipo'=> 0);
            $modalidades = $this->ModalidadeTematicaDAO->consultarTudo($consulta);
            $consulta['mote_tipo'] = 1;
            $eixosTematicos = $this->ModalidadeTematicaDAO->consultarTudo($consulta);
            
            $data['modalidades'] = $modalidades;
            $data['eixos'] = $eixosTematicos;
            $data['regrasSubmissao'] = $edicao->getDiretrizesSubmissao();
            return $data;
        }

        public function cadastrar() {            
            $data = $this->consultarModalidadesEixos(); 

            $this->setaValores();
            $data['artigo'] = $this->artigo;
            if($this->valida() && !empty($this->input->post())){

                $this->db->trans_start();
                    $codigoArtigo =  $this->ArtigoDAO->inserir($this->artigo);
                $this->db->trans_complete();

                if($this ->db->trans_status() === TRUE){
                    $this->session->set_flashdata('success', 'O seu trabalho foi submetido com sucesso!');
                    unset($data['artigo']);
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível submeter o seu trabalho!');
                }

            }
            $data['title'] = 'IFEvents - Novo Trabalho';
            $data['tituloh2'] = "<h2><span class='fa fa-file'></span><b> Novo Trabalho</b></h2>";
            return $this->chamaView("form-artigo", "participante", $data, 1);
        }

        public function alterar($codigo) {
            $data = $this->consultarModalidadesEixos(); 
            $this->artigo = $this->ArtigoDAO->consultarCodigo($codigo);
            $this->setaValores();
            $data['artigo'] = $this->artigo;
            if($this->valida() && !empty($this->input->post())){

                $this->db->trans_start();
                    $codigoArtigo =  $this->ArtigoDAO->inserir($this->artigo);
                $this->db->trans_complete();

                if($this ->db->trans_status() === TRUE){
                    $this->session->set_flashdata('success', 'O seu trabalho foi atualizado com sucesso!');
                    unset($data['artigo']);
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível atualizar o seu trabalho!');
                }

            }
            $data['title'] = 'IFEvents - Atualizar dados do trabalho';
            $data['tituloh2'] = "<h2><span class='fa fa-file'></span><b> Atualizar dados do Trabalho</b></h2>";
            return $this->chamaView("form-artigo", "participante", $data, 1);
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

        private function valida(){
            $this->form_validation->set_rules( 'titulo','Título', 'trim|required|max_length[100]' );		
            $this->form_validation->set_rules( 'autor[]', 'Autor(es)', 'trim|required|max_length[200]' );
            $this->form_validation->set_rules( 'modalidade', 'Tipo de Modalidade', 'required' );
            $this->form_validation->set_rules( 'area', 'Eixo Temático', 'required' );		
            $this->form_validation->set_rules( 'orientador', 'Orientador', 'trim|required|max_length[100]' );
            $this->form_validation->set_rules( 'resumo', 'Resumo', 'trim|required|max_length[500]' );
            if(!$this->aceita_subm()){
                $this->form_validation->set_rules( 'aceite', 'Aceite', 'callback_aceita_subm' );
            }
            return $this->form_validation->run();
        }

        public function aceita_subm(){
            if ($this->input->post('aceite') || $this->artigo->getCodigo()!==null){
                $this->session->set_flashdata('checked','checked');
                return TRUE;
            }
            else{
                $error = 'Por favor, leia e aceite as diretrizes de submissão de trabalhos científicos.';
                $this->form_validation->set_message('aceita_subm', $error);
                return FALSE;
            }
        }
        
        private function obtemStringAutores($arrayAutores){
            if(null !== $arrayAutores){
                 natcasesort($arrayAutores);
                $i = 0;
                $codigo_autores = array();
                foreach ($arrayAutores as $key => $value) {
                    if(preg_match("/\d+/", htmlentities($value)) > 0){
                        $codigo_autores[$i] = somenteNumeros($value);
                        $i++;
                    }
                    $this->autores[$key] =  $value;
                }

                return implode(', ', $arrayAutores);
            }
        }
        
        private function setaValores(){
            $this->artigo->setTitulo($this->input->post( 'titulo' ));
            $arrayAutores = $this->input->post( 'autor' );
            $stringAutores = $this->obtemStringAutores($arrayAutores);
            $this->artigo->setAutores($stringAutores);
            $this->artigo->setOrientador($this->input->post( 'orientador' ));
            $this->artigo->setModalidade($this->input->post( 'modalidade' ));
            $this->artigo->setEixoTematico($this->input->post( 'area' ));
            $this->artigo->setResumo($this->input->post( 'resumo' ));
            $codigoAutorResp = $this->session->userdata('usuario')->user_cd;
            $this->artigo->setCodigoAutorResponsavel($codigoAutorResp);
            if($this->artigo->getStatus()===null){
                $this->artigo->setStatus('Aguardando Revisão!');
            }
        }
            



}
