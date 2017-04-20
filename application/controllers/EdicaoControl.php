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
    		$this->chamaView("nova-edicao", "organizador",
            	array("title"=>"IFEvents - Nova Edição"), 1);
    		return true;
    	}
    	$this->edicao->setaValores();
    	$this->edicao->valida();
    	$this->upload_image('teste', 100, 100, null, null);

    	if($this->form_validation->run()){

    	}

    	// echo print_r($this->edicao);

    	$this->chamaView("nova-edicao", "organizador",
            	array("title"=>"IFEvents - Nova Edição", "edicao" => $this->edicao), 1);
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
