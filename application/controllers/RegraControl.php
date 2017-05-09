<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class RegraControl extends PrincipalControl implements InterfaceControl{
	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/RegraDAO' );
		$this->load->Model( 'RegraModel','regra' );
	}

	public function cadastrar(){

	}

	public function alterar($codigo){

	}

	public function consultar(){
		 $data['title']="IFEvents - Regras de Submissão de Trabalhos";
        $this->chamaView("regras-submissao", "organizador", $data ,1);
	}

	public function excluir($codigo){

	}


}