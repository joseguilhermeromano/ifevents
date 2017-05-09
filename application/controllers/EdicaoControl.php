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

    	if($this->form_validation->run()){

    	}

    	$this->chamaView("nova-edicao", "organizador",
            	array("title"=>"IFEvents - Nova Edição", "edicao" => $this->edicao), 1);
	}

	public function alterar($codigo){
		return null;
	}

	public function excluir($codigo){
		return null;
	}

	public function consultar(){
		$this->chamaView("edicoes", "organizador", array('title' => 'IFEvents - Edições'), 1);
	}

	public function consultarTudo(){
		$this->chamaView("edicoes", "organizador", array('title' => 'IFEvents - Edições'), 1);
	}
}
