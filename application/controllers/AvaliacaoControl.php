<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class AvaliacaoControl extends PrincipalControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/AvaliacaoDAO' );
		$this->load->Model( 'dao/EdicaoDAO' );
                $this->load->Model( 'dao/RevisorDAO' );
                $this->load->Model( 'dao/ArtigoDAO' );
                $this->load->Model( 'dao/SubmissaoDAO' );
		$this->load->Model( 'dao/ModalidadeTematicaDAO' );
		$this->load->Model( 'AvaliacaoModel','avaliacao' );
	}

	public function emitirEditarParecer($codigoRevisao){
            $this->avaliacao = $this->AvaliacaoDAO->consultarCodigo($codigoRevisao);
            $data = array("title"=>"IFEvents - Emitir/Editar Parecer",
            "tituloh2" => "<h2><span class='fa fa-pencil-square-o'></span><b> Emitir/Editar Parecer</b></h2>");
            if (empty($this->input->post())){
                $data['avaliacao'] = $this->avaliacao;
    		return $this->chamaView("form-parecer", "avaliador", $data, 1);
            }
            $parecer = $this->avaliacao->getParecer();
            $this->setaValores();

            if($this->valida()){

                $this->db->trans_start();
                $this->AvaliacaoDAO->alterar($this->avaliacao);
                $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $mensagem = $parecer === null ? 'O Parecer foi emitido com sucesso!'
                    : 'O Parecer foi editado com sucesso!';
                    $this->session->set_flashdata('success', $mensagem);
                    $url = $this->isOrganizador() == true ? "revisao/consultar-resultados"
                        : "revisao/consultar";
                    redirect($url);
                }else{
                   $this->session->set_flashdata('error', 'Não foi possível emitir o parecer!');
                }

            }
            $data['avaliacao'] = $this->avaliacao;
            $this->chamaView("form-parecer", "avaliador", $data, 1);
            
	}
        
        public function emitirParecerFinal($codigoSubm){
            $data = array("title"=>"IFEvents - Emitir Parecer Final",
            "tituloh2" => "<h2><span class='fa fa-gavel'></span><b> Emitir Parecer Final</b></h2>");
            $data['avaliacao'] = $this->avaliacao;
            if (empty($this->input->post())){
    		return $this->chamaView("form-parecer", "avaliador", $data, 1);
            }
            $codigoUsuario = $this->session->userdata('usuario')->user_cd;
            $revisor = $this->OrganizadorDAO->consultarCodigo($codigoUsuario);
            $submissao = $this->SubmissaoDAO->consultarCodigo($codigoSubm);
            $urlAnterior= $this->input->post('url_anterior');
            $this->avaliacao->setRevisor($revisor);
            $this->avaliacao->setConfirmaRevisao(1);
            $this->avaliacao->setSubmissao($submissao);
            $this->setaValores();

            if($this->valida()){

                $this->db->trans_start();
                $codigoRevisao = $this->AvaliacaoDAO->inserir($this->avaliacao);
                $parecerFinal = $this->DisparaEmailDivulgacaoResultado($codigoRevisao);
                $this->db->trans_complete();
                

                if($this ->db->trans_status() !== FALSE && $parecerFinal == true){
                    $this->session->set_flashdata('success', 'O Parecer Final '
                    . 'para <b>'.$submissao->getArtigo()->getTitulo().'</b> foi emitido com sucesso!');
                    redirect($urlAnterior);
                }else{
                   $this->session->set_flashdata('error', 'Não foi possível emitir o parecer final para <b>'
                   .$submissao->getArtigo()->getTitulo().'</b>!');
                }

            }
            $data['avaliacao'] = $this->avaliacao;
            $data['urlAnterior']= $urlAnterior;
            $this->chamaView("form-parecer", "avaliador", $data, 1);  
	}
        
        private function valida(){
            $this->form_validation->set_rules(	'resultado', 'Resultado', 'trim|required|max_length[100]' );
            $this->form_validation->set_rules(	'observacoes', 'Observações', 'trim|required|max_length[50]' );
            return $this->form_validation->run();
        }

        private function setaValores(){
            date_default_timezone_set('America/Sao_Paulo');
            $this->avaliacao->setStatus($this->input->post('resultado'));
            $this->avaliacao->setParecer($this->input->post('observacoes'));
            $this->avaliacao->setData(date('y-m-d'));
            $this->avaliacao->setHora(date('H:i'));
        }

	public function alterar($codigo){

	}
        
        private function consultaModaEixosParaSelecionar($codigoEdicao, $data){
            
            $this->session->set_flashdata('info', 'Você primeiro deve selecionar'
            . ' as modalidades e eixos temáticos dos trabalhos que'
            . ' deseja revisar!'
            . '<br>'
            . '<a href="#" data-toggle="modal" data-target="#selecionarModalidadesEixos">'
            . '<b>Clique aqui</b>'
            . '</a>'
            . ' para selecionar as modalidades e eixos temáticos de interesse!');
            
            $consulta = array('mote_edic_cd' => $codigoEdicao,'mote_tipo' => 0);    
            $data['modalidades'] = $this->ModalidadeTematicaDAO->consultarTudo($consulta);
            $consulta['mote_tipo'] = 1;
            $data['eixosTematicos'] = $this->ModalidadeTematicaDAO->consultarTudo($consulta);
            return $data;
        }
        
        private function insereModaEixosSelecionados($modalidades, $eixos, $codigoRevisor){
            $inseriu = $this->ModalidadeTematicaDAO->insereModaTemaRevisor
            ($modalidades,$eixos, $codigoRevisor);
            if($inseriu == true){
                $this->session->set_flashdata('success', 'As modalidades e '
                . 'os eixos temáticos foram salvos com sucesso!');
                return;
            }
            $this->session->set_flashdata('error', 'Não foi possível salvar'
            . ' as modalidades e os eixos temáticos!');
            return;
        }
        
        private function selecionarModalidadesEixos($codigoEdicao, $codigoRevisor){
            $inputModalidades = $this->input->post('modalidades');
            $inputEixos = $this->input->post('eixos');
            
            $data = array("title"=>"IFEvents - Revisões Pendentes"
            ,"inputmodalidades" => $inputModalidades
            , "inputeixos" => $inputEixos);
                
            if(sizeof($inputModalidades) >= 1 || sizeof($inputEixos) >= 1){
                $this->insereModaEixosSelecionados($inputModalidades, 
                    $inputEixos, $codigoRevisor);
                redirect('revisao/consultar');
            }
            
            $this->load->helper('html');
            $this->session->set_flashdata('warning', 'Você deve selecionar'
            . ' pelo menos uma modalidade e um eixo temático!');
            $data['mensagem'] = alert($this->session);
            
            $data = $this->consultaModaEixosParaSelecionar($codigoEdicao, $data);
            
            return $this->chamaView("revisoes-pendentes", "avaliador", $data, 1); 
        }
        
        private function selecionouModaEixos($codigoEdicao, $codigoRevisor){
            $consulta = $this->ModalidadeTematicaDAO
            ->consultarModaTemaRevisor($codigoEdicao, $codigoRevisor);
            if($consulta !== null){
                return true;
            }
            return false;
        }
        
	public function consultar(){
            $dataAtual = date('y-m-d');
            $codigoRevisor = $this->session->userdata('usuario')->user_cd;
            $codigoEdicao = $this->EdicaoDAO
                ->consultarUltimoEventoRevisor($dataAtual, $codigoRevisor);
            
            if($codigoEdicao == null){
                $this->session->set_flashdata("warning", "Não há eventos com o período "
                . "de revisões em aberto ou você talvez não tenha aceitado o convite"
                . " para participar das revisões! <br>Por favor, verique o seu e-mail!");
                $data['title'] = "IFEvents - Revisões Pendentes";
                return $this->chamaView("revisoes-pendentes", "avaliador", $data, 1);
            }
            
            $selecinouModaEixos = $this->selecionouModaEixos($codigoEdicao,$codigoRevisor);

            if($selecinouModaEixos == false){
                return $this->selecionarModalidadesEixos($codigoEdicao, $codigoRevisor);
            }
            
            $this->consultarRevisoesPendentes($codigoRevisor);
	}
        
        private function consultarRevisoesPendentes($codigoRevisor){
            $data = array("title"=>"IFEvents - Revisões Pendentes");
            $limite = 10;
            $pagina = $this->input->get('pagina');
            $numPagina = $pagina !== null ? $pagina : 0;
            $consulta = array('aval_user_cd' => $codigoRevisor);
            $busca = $this->input->get('busca');
            
            if( $busca!== null){
                $consulta['arti_title'] = $busca;
            }

            $revisoesPendentes = $this->AvaliacaoDAO->consultarTudo($consulta,
                $limite,$numPagina);
            
            if(!empty($revisoesPendentes)){
                $totalRegistros = count($this->AvaliacaoDAO->consultarTudo($consulta));
                $data['revisoes'] = $revisoesPendentes;
                $data['totalRegistros'] = $totalRegistros;
                $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros
                , 'revisao/consultar/?busca='.$busca);
            }else{
                $this->session->set_flashdata('info', 'Não há trabalhos para serem revisados!');
            }

            return $this->chamaView("revisoes-pendentes", "avaliador", $data, 1);
        }

	public function consultarAtribuicoes(){
            $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
            if( $this->input->get('busca') !== ''){
                $busca = $this->input->get('busca');
                $array = array(
                      'mote1.mote_edic_cd' => $codigoEdicao
                      ,'arti_title' => $busca);
            }else{
                $busca=null;
                $array=array('mote1.mote_edic_cd' => $codigoEdicao);
            }
            $data = $this->AvaliacaoDAO->consultarTrabalhosAindaNaoAtribuidos($array);
            $totalRegistros = sizeof($data);
            if($data == null && $busca == null){
                    $this->session->set_flashdata('info', 'Não há trabalhos para serem atribuídos!');
            }
            $this->chamaView("atribuicoes-submissoes", "organizador",
            array("title"=>"IFEvents - Atribuição de Trabalhos"
            , "atribuicoes" => $data
            , "totalRegistros" => $totalRegistros), 1);
	}

	public function consultaRevisoresAtribuicao(){
		$lista = null;
		$modalidade = $this->input->post('modalidade');
		$eixo = $this->input->post('eixo');

		if(!empty($modalidade) && !empty($eixo)){
			$revisores = $this->ModalidadeTematicaDAO->
                        consultarRevisorPorModalidadeTematica($modalidade, $eixo);
			if($revisores != null){
				$lista = array();
				foreach ($revisores as $key => $revisor) {
					$array = array('id' => $revisor->user_cd, 'text' => $revisor->user_nm);
					array_push($lista, $array);
				}

			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($lista));

	}
        
        public function consultarResultadosRevisoes(){
            $limite= 10;
            $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
            $busca= $this->input->get('busca');
            $array=array('mote_edic_cd' => $codigoEdicao);
            $pagina = $this->input->get('pagina');
            $numPagina = $pagina !== null ? $pagina : 0;
            if( !empty($busca) ){
                $array['arti_title'] = $busca;
            }
            $resultadosRevisoes = $this->AvaliacaoDAO->
                consultarResultadosRevisoes($array,$limite, $numPagina);
            $totalRegistros = count( $resultadosRevisoes );
            $data['resultadosRevisoes'] = $resultadosRevisoes;
            $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros
                , 'revisao/consultar-resultados/?busca='.$busca);
            $data['totalRegistros'] = $totalRegistros;
            $data['title'] = "IFEvents - Resultados das Revisões";
            $this->chamaView("resultados-revisoes", "organizador", $data, 1);
        }

	public function atribuirRevisor(){
            $revisores = $this->input->post('revisores');
            $submissao = $this->input->post('submissao');
            if($revisores!==null){
                $verifica = $this->AvaliacaoDAO->atribuirRevisor($revisores, $submissao);
                $artigo = $this->SubmissaoDAO->consultarCodigo($submissao)->getArtigo();
                $artigo->setStatus('Aguardando Revisão');
                $this->ArtigoDAO->alterar($artigo);
                if($verifica == 0){
                    $this->session->set_flashdata("success", 
                    "O Trabalho foi atribuído ao revisor com sucesso!");
                }else{
                    $this->session->set_flashdata("error", 
                    "Não foi possível atribuir o trabalho a um revisor!");
                }
            }else{
                $this->session->set_flashdata("error",
                "Não foi selecionado nenhum revisor!");
            }
            $this->consultarAtribuicoes();
	}

	public function excluir($codigo){

	}
        
        
        private function atualizaResultadoArtigo($revisao){
            $resultadoRevisao = $revisao->getStatus();
            $this->artigo = $revisao->getSubmissao()->getArtigo();
            $resultadoArtigo = '';
            switch($resultadoRevisao){
                case "Revisão Aprovada":
                    $resultadoArtigo = "Aprovado";
                    $this->artigo->setStatus($resultadoArtigo);
                    break;
                case "Revisão aprovada com ressalvas":
                    $resultadoArtigo = "Aprovado com ressalvas";
                    $this->artigo->setStatus($resultadoArtigo);
                    break;
                default: 
                    $resultadoArtigo = "Reprovado";
                    $this->artigo->setStatus($resultadoArtigo);
            }
            $this->ArtigoDAO->alterar($this->artigo);
            return $resultadoArtigo;
        }
        
        public function divulgarResultado($codigoRevisao){
           if($this->DisparaEmailDivulgacaoResultado($codigoRevisao)){
               $this->session->set_flashdata('success', 'O Resultado foi divulgado com sucesso!');
           }else{
               $this->session->set_flashdata('error', 'Não foi possível divulgar o resultado do Trabalho!');
           }
           redirect('revisao/consultar-resultados');
        }
        
        public function divulgarVariosResultados(){
            $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
            $array=array('mote_edic_cd' => $codigoEdicao);
            $revisoes = $this->AvaliacaoDAO->
                consultarResultadosRevisoes($array);
            $resultado = false;
            if(count($revisoes) > 0){
                foreach($revisoes as $revisao){
                    $resultado = $this->DisparaEmailDivulgacaoResultado($revisao->aval_cd);
                }
            }
            
            if($resultado == true){
                 $this->session->set_flashdata('success', 'Os Resultados foram divulgados com sucesso!');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível divulgar os resultados dos Trabalhos!');
            }
            redirect('revisao/consultar-resultados');
        }
         
        
        private function DisparaEmailDivulgacaoResultado($codigoRevisao){
           $revisao = $this->AvaliacaoDAO->consultarCodigo($codigoRevisao);
           $tituloArtigo = $revisao->getSubmissao()->getArtigo()->getTitulo();
           $resultadoArtigo = $this->atualizaResultadoArtigo($revisao);
           $data['tituloMensagem'] = "Resultado da Revisão";
           $data['corpoMensagem'] = "Prezado participante, o trabalho de cujo o título "
            . "<b>".$tituloArtigo."</b> obteve o seguinte resultado na revisão "
            . "<b>Trabalho ".strtolower($resultadoArtigo)."</b>! Por favor, consulte na plataforma "
            . "para maiores informações!";
           $assunto = "Resultado da Revisão - ".$tituloArtigo; 
           $destinatario = $revisao->getSubmissao()->getArtigo()
            ->getAutorResponsavel()->getEmail();
           $mensagem = $this->load->view("template-email/template-email", $data, true);
           return $this->envia_email($destinatario, $assunto, $mensagem);
        }
        
        public function confirmarResultadoRevisao($codigoRevisao){
            $revisao = $this->AvaliacaoDAO->consultarCodigo($codigoRevisao);
            $revisao->setConfirmaRevisao(1);
            
            $this->db->trans_start();
            $this->AvaliacaoDAO->alterar($revisao);
            $this->db->trans_complete();

            if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'O Resultado da revisão foi confirmado com sucesso!');
                redirect("revisao/consultar");
            }else{
               $this->session->set_flashdata('error', 'Não foi possível confirmar o resultado da revisão!');
            }
            
            redirect('revisao/consultar');
        }



}
