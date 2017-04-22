<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class EdicaoControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/EdicaoDAO' );
		$this->load->Model( 'EdicaoModel','edicao' );
	}

	public function cadastrar(){
	    if (empty($this->edicao->input->post())){
	    	$this->session->userdata('configInputFile') !==null ? $this->session->unset_userdata('configInputFile') : '';
    		$this->chamaView("nova-edicao", "organizador",
            	array("title"=>"IFEvents - Nova Edição"), 1);
    		return true;
    	}
    	$this->edicao->setaValores();
    	$this->edicao->valida();

    	// $this->edicao->edic_img="teste";
    	if(null=== $this->session->userdata('configInputFile')||(null!== $this->session->userdata('configInputFile') && !empty($_FILES['image_field']['name']))){
	    	if($this->input->post('conferencia')!==null){
		    	$nomeImagem = 'img_'.($this->EdicaoDAO->consultarUltimaEdicao($this->input->post('conferencia')) + 1).'_'.strtolower($this->edicao->conferencia->conf_abrev);
		    	
	    		$this->edicao->edic_img = $this->upload_image($nomeImagem, 'edicoes', null, null, 3543, 1181);
	    	}
    	}
    		
    	

    	if($this->form_validation->run()){

    	}


    	$this->chamaView("nova-edicao", "organizador",
            	array("title"=>"IFEvents - Nova Edição", "edicao" => $this->edicao), 1);
	}

	public function recuperaImagem(){
		$configInputFile = array();

		if(null !==$this->session->userdata('configInputFile')){

			$configInputFile = $this->session->userdata('configInputFile');
		
		}

		 $this->output->set_content_type('application/json')->set_output(json_encode($configInputFile));
	}

	public function geraNumeracaoEdicao(){
		header('Content-type: text');
		$novaEdicao = $this->EdicaoDAO->consultarUltimaEdicao($this->input->post('conf_cd')) + 1;
		$this->output->set_content_type('application/json')->set_output(json_encode($novaEdicao));
	}

	public function alterar($codigo){

	}

	public function excluir($codigo){

	}

	public function consultar(){
		$this->chamaView("edicoes", "organizador", array('title' => 'IFEvents - Edições'), 1);
	}
}
