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

	public function consultar(){
		$eventosRevisor = $this->EdicaoDAO->consultarEventosRevisor(date('y-m-d'),
			$this->session->userdata('usuario')->user_cd);

		$modalidades = null;
		$eixosTematicos = null;
		$mensagemModal = null;
		$modalidadesTematicas = null;
		if(!empty($eventosRevisor->core_user_cd)){
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
		}



		$limite = 10;
        $numPagina =0;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }

        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('arti_title'=>$busca
            	,'aval_user_cd' => $this->session->userdata('usuario')->user_cd);
        }else{
            $busca=null;
            $array=array('aval_user_cd' => $this->session->userdata('usuario')->user_cd);
        }

		$data = $this->AvaliacaoDAO->consultarTudo($array, $limite,$numPagina);
		if(empty($data)){
			$this->session->set_flashdata('info', 'Não há trabalhos para serem revisados!');
			return $this->chamaView("revisoes-pendentes", "avaliador",
        	array("title"=>"IFEvents - Revisões Pendentes"), 1);
		}


		$totalRegistros = count($this->AvaliacaoDAO->consultarTudo($array));


				return $this->chamaView("revisoes-pendentes", "avaliador",
        array("title"=>"IFEvents - Revisões Pendentes", "revisoes" => $data, "totalRegistros" => $totalRegistros), 1);
		// return $this->chamaView("revisoes-pendentes", "avaliador",
  //       array("title"=>"IFEvents - Revisões Pendentes"
  //       	, "modalidades" => $modalidades, "eixosTematicos" => $eixosTematicos, "mensagem" => $mensagemModal), 1);
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
			$revisores = $this->ModalidadeTematicaDAO->consultarRevisorPorModalidadeTematica($modalidade, $eixo);
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
