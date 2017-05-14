<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class AvaliacaoControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/AvaliacaoDAO' );
		$this->load->Model( 'AvaliacaoModel','avaliacao' );
	}

	public function cadastrar(){

	}

	public function alterar($codigo){

	}

	public function consultar(){
		return $this->chamaView("revisoes-pendentes", "avaliador",
        array("title"=>"IFEvents - Revisões Pendentes"), 1);
	}

	public function excluir($codigo){

	}



}