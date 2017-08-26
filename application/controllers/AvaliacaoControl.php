<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class AvaliacaoControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/AvaliacaoDAO' );
		$this->load->Model( 'dao/EdicaoDAO' );
                $this->load->Model( 'dao/RevisorDAO' );
		$this->load->Model( 'dao/ModalidadeTematicaDAO' );
		$this->load->Model( 'AvaliacaoModel','avaliacao' );
	}

	public function cadastrar(){
            if (empty($this->avaliacao->input->post())){
    		return $this->chamaView("form-parecer", "avaliador",
            	array("title"=>"IFEvents - Emitir Parecer",
            		"tituloh2" => "<h2><span class='glyphicon glyphicon-copy'></span><b> Emitir Parecer</b></h2>"), 1);
            }

    	// $this->avaliacao->setaValores();
    	// $this->avaliacao->valida();


    	// if($this->form_validation->run()){

    		// $this->db->trans_start();
    		// 	//pegar codigo da conferencia pela sessao (selecionada)
      //       	$this->modalidade->mote_conf_cd = 1;
      //       	$this->modalidade->mote_tipo = 0;
      //       	$this->ModalidadeTematicaDAO->inserir($this->modalidade);
    		// $this->db->trans_complete();

    		// if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'O Parecer foi emitido com sucesso!');
                $this->modalidade = null;
      //       }else{
      //       	$this->session->set_flashdata('error', 'Não foi possível cadastrar a modalidade!');
      //       }

    	// }


    	$this->chamaView("form-parecer", "avaliador",
            	array("title"=>"IFEvents - Emitir Parecer",
            	 "tituloh2" => "<h2><span class='fa fa-plus'></span><b> Emitir Parecer</b></h2>",
            	 "parecer" => $this->avaliacao), 1);
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

	public function atribuirRevisor(){
		$revisores = $this->input->post('revisores');
		$submissao = $this->input->post('submissao');
		if($revisores!==null){
			$verifica = $this->AvaliacaoDAO->atribuirRevisor($revisores, $submissao);
			if($verifica == 0){
				$this->session->set_flashdata("success", "O Trabalho foi atribuído ao revisor com sucesso!");
			}else{
				$this->session->set_flashdata("error", "Não foi possível atribuir o trabalho a um revisor!");
			}
		}else{
			$this->session->set_flashdata("error", "Não foi selecionado nenhum revisor!");
		}
		$this->consultarAtribuicoes();
	}

	public function excluir($codigo){

	}



}
