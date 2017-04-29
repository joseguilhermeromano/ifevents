<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ModalidadeControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/ModalidadeDAO' );
		$this->load->Model( 'ModalidadeModel','modalidade' );
	}

	public function cadastrar(){

	}

	public function alterar($codigo){

	}

	public function consultar(){
		$limite = 10;
        $numPagina =0;
        //pegar codigo da conferencia pela sessao 
        $conf_cd = 1;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }

        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('modalidade_tematica.mote_nm'=>$busca, 'modalidade_tematica.mote_tipo' => 0);
        }else{
            $busca=null;
            $array=null;
        }

        $data['modalidades']=$this->ModalidadeDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->ModalidadeDAO->totalRegistros($conf_cd), 'modalidade/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->ModalidadeDAO->totalRegistros($conf_cd);
         $data['title']="IFEvents - Modalidades";
        $this->chamaView("modalidades", "organizador", $data ,1);
	}

	public function excluir($codigo){

	}

}