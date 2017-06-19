<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class EdicaoControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/EdicaoDAO' );
        $this->load->Model( 'dao/ModalidadeTematicaDAO' );
		$this->load->Model( 'EdicaoModel','edicao' );
	}

	public function cadastrar(){
	    if (empty($this->edicao->input->post())){
	    	$this->session->userdata('configInputFile') !==null ? $this->session->unset_userdata('configInputFile') : '';
    		$this->chamaView("form-edicao", "organizador",
            	array("title"=>"IFEvents - Nova Edição",
            		"tituloh2" => "<h2><span class='fa fa-calendar-plus-o'></span><b> Nova Edição</b></h2>"), 1);
    		return true;
    	}
    	$this->edicao->setaValores();
    	$this->edicao->valida();


    	if($this->form_validation->run()){
            $this->edicao->edic_num = $this->EdicaoDAO->consultarUltimaEdicao($this->input->post('conferencia')) + 1;

            $this->edicao->edic_img_nm ='img_'.$this->edicao->edic_num.'_'.strtolower($this->edicao->conferencia->conf_abrev);


	    	if($this->session->userdata('configInputFile') === null || ($this->session->userdata('configInputFile') !== null && !empty($_FILES['image_field']['name']))){

		    		$this->edicao->edic_img = $this->upload_image($this->edicao->edic_img_nm, 'edicoes',
		    		 null, null, 3543, 1181);

	    	}

    		$this->db->trans_start();
            try{
            	$email = $this->EmailDAO->consultarTudo($this->edicao->email)[0];
            	if(sizeof($email) == 0){
                	$this->edicao->edic_email_cd = $this->EmailDAO->inserir($this->edicao->email);
            	}else{
            		$this->edicao->edic_email_cd = $email->email_cd;
            	}
                $this->edicao->edic_tele_cd = $this->TelefoneDAO->inserir($this->edicao->telefone);
                $this->edicao->edic_regr_cd = $this->RegraDAO->inserir($this->edicao->regra);
                $edic_cd = $this->EdicaoDAO->inserir($this->edicao);
                $this->LocalidadeDAO->inserirEnderecoEdicao($this->edicao, $edic_cd);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'A Edição foi cadastrada com sucesso!');
                $this->session->unset_userdata('configInputFile');
                $this->edicao = null;
            }else{
                $this->session->set_flashdata('error', 'Não foi possível cadastrar a nova edição!');
            }

    	}


    	$this->chamaView("form-edicao", "organizador",
            	array("title"=>"IFEvents - Nova Edição",
            	 "tituloh2" => "<h2><span class='fa fa-calendar-plus-o'></span><b>Nova Edição</b></h2>",
            	 "edicao" => $this->edicao), 1);
	}

	public function recuperaImagem(){
		$configInputFile = array();

		if(null !==$this->session->userdata('configInputFile')){

			$configInputFile = $this->session->userdata('configInputFile');

		}

		 $this->output->set_content_type('application/json')->set_output(json_encode($configInputFile));
	}

	public function geraNumeracaoEdicao(){
		$novaEdicao = $this->EdicaoDAO->consultarUltimaEdicao($this->input->post('conf_cd')) + 1;
		$this->output->set_content_type('application/json')->set_output(json_encode($novaEdicao));
	}

	public function alterar($codigo){
		$edicao = $this->EdicaoDAO->consultarCodigo($codigo);
		if (empty($this->edicao->input->post()) && isset($codigo)) {
	    	$this->session->userdata('configInputFile') !==null ? $this->session->unset_userdata('configInputFile') : '';

	    	$configInputFile = array(
            "initialPreview" => "<img src='".base_url($edicao->edic_img)."' class='file-preview-image kv-preview-data img-responsive' style='with:auto; height: auto; max-height:160px' title='"
            .basename($edicao->edic_img)."' >",
            "initialPreviewConfig" => array('caption' => basename($edicao->edic_img),
                "size" => filesize($edicao->edic_img)),
            "initialPreviewAsData" => false,
            "initialPreviewShowDelete" => false,
            "initialCaption" =>  basename($edicao->edic_img),
            "maxFileSize" => "1000000",
            "overwriteInitial" => true
            );

            $this->session->set_userdata("configInputFile",$configInputFile);

    		$this->chamaView("form-edicao", "organizador",
            	array("title"=>"IFEvents - Editar Edição",
            		"tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Atualizar Edição</b></h2>",
            		"edicao" => $edicao), 1);
    		return true;
    	}
    	$this->edicao->setaValores();
    	$this->edicao->valida();


    	if($this->form_validation->run()){
             $this->edicao->edic_num = $edicao != null ? $edicao->edic_num :
             $this->EdicaoDAO->consultarUltimaEdicao($this->input->post('conferencia')) + 1;

            $this->edicao->edic_img_nm ='img_'.$this->edicao->edic_num.'_'.strtolower($this->edicao->conferencia->conf_abrev);

	    	if($this->session->userdata('configInputFile') === null ||($this->session->userdata('configInputFile') !== null && !empty($_FILES['image_field']['name']))){

		    		$this->edicao->edic_img = $this->upload_image($this->edicao->edic_img_nm, 'edicoes',
		    		 null, null, 3543, 1181);

	    	}

			$this->db->trans_start();
			 $verificaTel = $this->TelefoneDAO->verificaTelefoneExiste($this->edicao->telefone->tele_fone);
            if(null === $edicao->telefone->tele_cd){
                $this->edicao->edic_tele_cd = $this->TelefoneDAO->inserir($this->edicao->telefone);
            }else if($verificaTel!=null){
                $this->edicao->edic_tele_cd = $verificaTel;
            }else if($edicao->telefone->tele_fone != $this->edicao->telefone->tele_fone){
                $edicoes = $this->EdicaoDAO->consultarTudo();
                $numedicoes=0;
                foreach ($edicoes as $key => $value) {
                    $value->edic_tele_cd == $edicao->edic_tele_cd ? $numedicoes++ :'';
                }
                if($numedicoes > 1){
                    $this->edicao->edic_tele_cd = $this->TelefoneDAO->inserir($this->edicao->telefone);
                }else{
                    $this->edicao->edic_tele_cd = $edicao->edic_tele_cd;
                    $this->edicao->telefone->tele_cd = $edicao->edic_tele_cd;
                    $this->TelefoneDAO->alterar($this->telefone);
                }
            }
            $this->edicao->edic_img = null === $this->edicao->edic_img ? $edicao->edic_img : $this->edicao->edic_img;
            $this->edicao->edic_cd = $edicao->edic_cd;
            $this->edicao->edic_regr_cd = $edicao->regra->regr_cd;
            $this->edicao->regra->regr_cd = $edicao->regra->regr_cd;
            $this->edicao->edic_email_cd = $edicao->email->email_cd;
            $this->EdicaoDAO->alterar($this->edicao);
            $this->RegraDAO->alterar($this->edicao->regra);
            $this->LocalidadeDAO->alterarEnderecoEdicao($this->edicao->localidade, $edicao->edic_cd);
            $this->edicao->email->email_cd = $edicao->edic_email_cd;
            $this->EmailDAO->alterar($this->edicao->email);
            $this->db->trans_complete();

            if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'A Edição foi atualizada com sucesso!');
            }else{
            	$this->session->set_flashdata('error', 'Não foi possível atualizar a edição!');
                $this->chamaView("form-edicao", "organizador",
                array("title"=>"IFEvents - Nova Edição",
                 "tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Atualizar Edição</b></h2>",
                 "edicao" => $this->edicao), 1);
            }

    	}

        redirect('edicao/consultar');

	}

	public function excluir($codigo){

	}

	public function consultar(){
		$limite = 10;
        $numPagina =0;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }

        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $numEdicao = preg_replace("/\D/","", $busca);
            $busca =  preg_replace("/[^A-Za-z]/", "", $busca);
            $array = array('Conferencia.conf_abrev'=>$busca, 'edic_num'=> $numEdicao);
        }else{
            $busca=null;
            $array=null;
        }

        $data['edicoes']=$this->EdicaoDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->EdicaoDAO->totalRegistros(), 'edicao/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->EdicaoDAO->totalRegistros();
        $data['title']="IFEvents - Edições";
        $this->chamaView("edicoes", "organizador", $data, 1);
	}

    public function revisores(){
        $limite = 10;
        $numPagina =0;
        $conf_cd = 1;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }

        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('user_nm'=>$busca, 'Conferencia_Revisor.core_conf_cd'=>$conf_cd);
        }else{
            $busca=null;
            $array = array('Conferencia_Revisor.core_conf_cd'=>$conf_cd);
        }

        $revisores =$this->EdicaoDAO->consultarRevisores($array, $limite, $numPagina);
        if($revisores !== null){
            foreach ($revisores as $revisor) {
                $revisor->modalidadesEixos = $this->ModalidadeTematicaDAO->consultarModaTemaRevisor($revisor->user_cd, $revisor->core_conf_cd);
            }
        }
        $data['revisores'] = $revisores;
        $totalRegistros = count($this->EdicaoDAO->consultarRevisores($array, $limite, $numPagina));
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, 'usuario/consultar/?busca='.$busca);
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Revisores";
        $this->chamaView("revisores", "organizador", $data, 1);
    }

    public function selecionarEvento($edicao){
        
        foreach ($this->session->userdata('eventos_recentes') as $key => $value) {
            if($value->edic_cd == $edicao){
                $this->session->set_userdata('evento_selecionado',$value);
            }
        }
        redirect('organizador/inicio');
    }

    public function aceiteConviteRevisor($revisor, $conferencia){
        $retorno = $this->EdicaoDAO->aceitarRecusarConvite($revisor, $conferencia, "Convite Aceito");
        if($retorno == 0){
            $this->session->set_flashdata('success','O Convite foi aceito com sucesso! É muito gratificante poder contar com sua colaboração!');
        }else{
            $this->session->set_flashdata('error','Não foi possível aceitar o convite!');
        }
        redirect('revisao/consultar');
    }

    public function recusaConviteRevisor($revisor, $conferencia){
        $retorno = $this->EdicaoDAO->aceitarRecusarConvite($revisor, $conferencia, "Convite Recusado");
        if($retorno == 0){
            $this->session->set_flashdata('success','O Convite foi recusado com sucesso!');
        }else{
            $this->session->set_flashdata('error','Não foi possível recusar o convite!');
        }
         redirect('revisao/consultar');
    }

    public function excluirConvite($revisor, $conferencia){
        $retorno = $this->EdicaoDAO->excluirConvite($revisor, $conferencia);
        if($retorno == 0){
            $this->session->set_flashdata('success','O Revisor foi removido do evento com sucesso!');
        }else{
            $this->session->set_flashdata('error','Não foi possível remover o revisor neste evento!');
        }
         redirect('revisor/consultar');
    }

}
