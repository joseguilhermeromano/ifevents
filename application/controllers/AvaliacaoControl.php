<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class AvaliacaoControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/AvaliacaoDAO' );
		$this->load->Model( 'dao/EdicaoDAO' );
		$this->load->Model( 'dao/ModalidadeTematicaDAO' );
		$this->load->Model( 'AvaliacaoModel','avaliacao' );
	}

	public function cadastrar(){

	}

	public function alterar($codigo){

	}

	public function consultar(){
		$eventosRevisor = $this->EdicaoDAO->consultarEventosRevisor(date('y-m-d'),
			$this->session->userdata('usuario')[0]['user_cd'])[0];


		if(empty($eventosRevisor->core_user_cd)){
			// $this->session->set_flashdata('info', 'Ainda não há eventos com o período de revisões aberto!');
			return $this->chamaView("revisoes-pendentes", "avaliador",
        	array("title"=>"IFEvents - Revisões Pendentes"), 1);
		}

		$modalidades = null;
		$eixosTematicos = null;
		$mensagemModal = null;

		$modalidadesTematicas = $this->ModalidadeTematicaDAO->consultarModaTemaRevisor($eventosRevisor->core_user_cd, $eventosRevisor->core_conf_cd);

		if($modalidadesTematicas == null){
			$this->session->set_flashdata('info', 'Você primeiro deve selecionar as modalidades e eixos temáticos dos trabalhos que deseja revisar!<br><a href="#" data-toggle="modal" data-target="#selecionarModalidadesEixos"><b>Clique aqui</b></a> para selecionar as modalidades e eixos temáticos de interesse!');
			$modalidades = $this->ModalidadeTematicaDAO->
			consultarTudo(array('mote_conf_cd' => $eventosRevisor->edic_conf_cd
				,'mote_tipo' => 0));
			$eixosTematicos = $this->ModalidadeTematicaDAO->
			consultarTudo(array('mote_conf_cd' => $eventosRevisor->edic_conf_cd
				,'mote_tipo' => 1));
		}

		if($this->input->post('modalidades') ||
			$this->input->post('eixos')){
			$inputModalidades = $this->input->post('modalidades');
			$inputEixos = $this->input->post('eixos');
			if(sizeof($inputModalidades) < 1 || sizeof($inputEixos) < 1){
				$this->load->helper('html');
				$this->session->set_flashdata('error', 'Você deve selecionar pelo menos uma modalidade e um eixo temático!');
				$mensagemModal = alert($this->session);

				return $this->chamaView("revisoes-pendentes", "avaliador",
		        array("title"=>"IFEvents - Revisões Pendentes"
		        	, "modalidades" => $modalidades, "eixosTematicos" => $eixosTematicos, "mensagem" => $mensagemModal,
		        	"inputmodalidades" => $inputModalidades, "inputeixos" => $inputEixos), 1);
			}else{
				$verifica = $this->ModalidadeTematicaDAO->insereModaTemaRevisor($inputModalidades,$inputEixos,$eventosRevisor->core_user_cd);
				if($verifica==0){
					$this->session->set_flashdata('success', 'As modalidades e os eixos temáticos foram salvos com sucesso!');
					$modalidades = null;
					$eixos = null;
				}else{
					$this->session->set_flashdata('error', 'Não foi possível salvar as modalidades e os eixos temáticos!');
				}
			}
		}



		
		return $this->chamaView("revisoes-pendentes", "avaliador",
        array("title"=>"IFEvents - Revisões Pendentes"
        	, "modalidades" => $modalidades, "eixosTematicos" => $eixosTematicos, "mensagem" => $mensagemModal), 1);
	}

	public function consultarAtribuicoes(){
		$conf_cd = 1;
		if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array(
            	  'Artigo.arti_title'=>$busca
            	, 'mote1.mote_nm' => $busca
            	, 'mote2.mote_nm' => $busca
            	, 'mote1.mote_conf_cd' => $conf_cd);
        }else{
            $busca=null;
            $array=array('mote1.mote_conf_cd' => $conf_cd);
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
		$array = null;
		if(!empty($this->input->post('submissoes'))){
			$array = array('id' => 1, 'text' => 'ok!');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($array));

	}

	public function excluir($codigo){

	}



}