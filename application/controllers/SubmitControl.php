<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';

class SubmitControl extends PrincipalControl{

	public function __construct(){
		parent::__construct();

		// $this->load->Model( 'dao/SubmitDAO' );
		// $this->load->Model('SubmitModel','submissao');
	}

    public function submeterArtigo(){
    	// $this->submissao->input = $this->session->flashdata('input');
    	// $this->submissao->subm_arti_cod=$this->session->flashdata('idArtigo');
    	// echo ($this->session->flashdata('file'));
    	// echo ($this->session->flashdata('idArtigo'));
    	echo "Passou por aqui!!!!!!!!!!!!!!!!!!!!";

    //     if($this->submissao->upload_arquivo()!=null){
    //         $this->submissao->setaValores();
    //         if($this->SubmitDAO->inserir($this->submissao)==true){
    //             $this->session->set_flashdata( 'success', 'A Submissão foi realizada com sucesso!' );
    //         }else{
    //             $this->session->set_flashdata( 'error', 'Não foi possível realizar a submissão!' );
    //         }
    //     }else{
    //         $this->session->set_flashdata( 'error', 'O arquivo não foi selecionado!' );
    //     }
    }

}