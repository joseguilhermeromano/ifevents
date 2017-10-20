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
                $this->load->Model('dao/EdicaoDAO');
                $this->load->Model('dao/AvaliacaoDAO');
                $this->load->Model('dao/SubmissaoDAO');
                $this->load->Model('dao/UsuarioDAO');
        }
        
        private function consultarModalidadesEixos($codigoEdicao){
            if($codigoEdicao === null){
                $this->session->set_flashdata('error', 'Não foi selecionado nenhum '
                        . 'evento que apresente submissões abertas!');
                redirect('artigo/consultar');
            }
            
            $consulta = array('mote_edic_cd'=>$codigoEdicao
            , 'mote_tipo'=> 0);
            $modalidades = $this->ModalidadeTematicaDAO->consultarTudo($consulta);
            $consulta['mote_tipo'] = 1;
            $eixosTematicos = $this->ModalidadeTematicaDAO->consultarTudo($consulta);
            
            $data['modalidades'] = $modalidades;
            $data['eixos'] = $eixosTematicos;
            $edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
            $data['regrasSubmissao'] = $edicao->getDiretrizesSubmissao();
            return $data;
        }

        public function cadastrar() {
            $codigoEdicao = $this->uri->segment(3);
            $data = $this->consultarModalidadesEixos($codigoEdicao); 

            $this->setaValores();
            $data['artigo'] = $this->artigo;
            if($this->valida() && !empty($this->input->post())){

                $this->db->trans_start();
                    $codigoArtigo =  $this->ArtigoDAO->inserir($this->artigo); 
                $this->db->trans_complete();

                if($this ->db->trans_status() === TRUE){
                   redirect('submissao/cadastrar/'.$codigoArtigo);
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível cadastrar o seu trabalho!');
                }

            }
            $data['title'] = 'IFEvents - Novo Trabalho';
            $data['tituloh2'] = "<h2><span class='fa fa-file'></span><b> Novo Trabalho</b></h2>";
            return $this->chamaView("form-artigo", "participante", $data, 1);
        }

        public function alterar($codigo) {
            $this->verificaPrimeiraSubmissao($codigo);
            $this->artigo = $this->ArtigoDAO->consultarCodigo($codigo);
            $this->aceita_subm();
            $codigoEdicao = $this->artigo->getModalidade()->mote_edic_cd;
            $data = $this->consultarModalidadesEixos($codigoEdicao); 
            if(!empty($this->input->post())){
                $this->setaValores();
                if($this->valida()){
                    $this->db->trans_start();
                        $this->ArtigoDAO->alterar($this->artigo);
                        redirect('submissao/alterar/'.$this->artigo->getCodigo());
                    $this->db->trans_complete();
                    if($this ->db->trans_status() === TRUE){
                        $this->session->set_flashdata('success', 'O seu trabalho foi atualizado com sucesso!');
                        redirect('artigo/consultar');
                    }else{
                        $this->session->set_flashdata('error', 'Não foi possível atualizar o seu trabalho!');
                    }
                }
            }
            $data['artigo'] = $this->artigo;
            $data['title'] = 'IFEvents - Atualizar dados do trabalho';
            $data['tituloh2'] = "<h2><span class='fa fa-file'></span><b> Atualizar dados do Trabalho</b></h2>";
            return $this->chamaView("form-artigo", "participante", $data, 1);
        }


        private function verificaPrimeiraSubmissao($codigoArtigo){
            $consulta = $this->SubmissaoDAO->totalRegistros($codigoArtigo);
            if($consulta <= 1){
                return;
            }
             redirect('submissao/alterar/'.$codigoArtigo);
        }

        public function detalharTrabalho($codigo){
            $data['artigo'] = $this->ArtigoDAO->consultarCodigo($codigo);
            $data['submissoes'] = $this->SubmissaoDAO->consultarPorArtigo($codigo);
            $data['title'] = "IFEvents - Detalhes do Trabalho";
            $this->chamaView("historico-submissao", "usuario", $data, 1);
        }



        public function consultar() {
            $limite = 10;
            $numPagina =0;
            if(null !== $this->input->get('pagina')){
                $numPagina = $this->input->get('pagina');
            }
            $codigoUsuario = $this->session->userdata('usuario')->user_cd;
            $array = array('Autoria.auto_user_cd' => $codigoUsuario);
            $busca = $this->input->get('busca');
            if($busca !== null){
                $busca = $this->input->get('busca');
                $array['Artigo.arti_title']= $busca;
            }
            $data['itens']=$this->ArtigoDAO->consultarTudo($array, $limite, $numPagina);
            $data['paginacao'] = $this->geraPaginacao($limite
                    , $this->ArtigoDAO->totalRegistros()
                    , 'artigo/consultar/?busca='.$busca);
            $data['totalRegistros'] = $this->ArtigoDAO->totalRegistros();
            $data['title']="IFEvents - Meus Trabalhos";
            $this->chamaView("meusartigos", "participante", $data, 1);
        }
        
        public function consultaResultadosFinais(){
            $limite = 10;
            $numPagina =0;
            if(null !== $this->input->get('pagina')){
                $numPagina = $this->input->get('pagina');
            }
            $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
            $codigoUsuario = $this->session->userdata('usuario')->user_cd;
            $array['mote1.mote_edic_cd'] = $codigoEdicao;
            $busca = $this->input->get('busca');
            if($busca !== null){
                $busca = $this->input->get('busca');
                $array['Artigo.arti_title']= $busca;
            }
            $data['itens']=$this->ArtigoDAO->consultarTudo($array, $limite, $numPagina);
            $data['paginacao'] = $this->geraPaginacao($limite
                    , $this->ArtigoDAO->totalRegistros()
                    , 'artigo/consultar/?busca='.$busca);
            $data['totalRegistros'] = $this->ArtigoDAO->totalRegistrosResultadosFinais();
            $data['title']="IFEvents - Resultados finais dos trabalhos";
            $this->chamaView("resultados-finais-artigos", "organizador", $data, 1);
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
        
        public function cancelarArtigo($codigoArtigo){
            $this->artigo = $this->ArtigoDAO->consultarCodigo($codigoArtigo);
            $status = $this->artigo->getStatus();
            if($status == 'Aprovado' || $status == 'Reprovado'){
                $this->session->set_flashdata('error', 'Sua submissão já está fechada! '
                        . 'Não é possível cancelar!');
                redirect('artigo/consultar');
            }
            $this->artigo->setStatus('Cancelado');
            $this->db->trans_start();
                $this->ArtigoDAO->alterar($this->artigo);
            $this->db->trans_complete();
            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'Sua submissão foi cancelada com sucesso!');
                redirect('artigo/consultar');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível cancelar a sua submissão!');
            }
        }
        
        private function valida(){
            $this->form_validation->set_rules( 'titulo','Título', 'trim|required|max_length[100]' );		
            $this->form_validation->set_rules( 'autores[]', 'Autor(es)', 'trim|required|max_length[200]' );
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
            if ($this->input->post('aceite') 
                    || $this->artigo->getCodigo()!==null){
                $this->session->set_flashdata('checked','checked');
                return TRUE;
            }
            else{
                $error = 'Por favor, leia e aceite as diretrizes de submissão de trabalhos científicos.';
                $this->form_validation->set_message('aceita_subm', $error);
                return FALSE;
            }
        }
        
        
        
        private function setaValores(){
            $this->artigo->setTitulo($this->input->post( 'titulo' ));
            $arrayAutores = $this->input->post( 'autores' );
            $this->artigo->setAutores($arrayAutores);
            $this->artigo->setOrientador($this->input->post( 'orientador' ));
            $codigoModalidade = $this->input->post( 'modalidade' );
            $modalidade = $this->ModalidadeTematicaDAO->consultarCodigo($codigoModalidade);
            $this->artigo->setModalidade($modalidade);
            $codigoEixo = $this->input->post( 'area' );
            $eixo = $this->ModalidadeTematicaDAO->consultarCodigo($codigoEixo);
            $this->artigo->setEixoTematico($eixo);
            $this->artigo->setResumo($this->input->post( 'resumo' ));
            $codigoAutor = $this->session->userdata('usuario')->user_cd;
            $autorResp = $this->UsuarioDAO->consultarCodigo($codigoAutor);
            $this->artigo->setAutorResponsavel($autorResp);
            if($this->artigo->getStatus()===null){
                $this->artigo->setStatus('Aguardando Revisão!');
            }
        }



}
