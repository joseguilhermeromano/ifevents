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
    		

    	if($this->form_validation->run()){

	    	if($this->session->userdata('configInputFile') === null ||($this->session->userdata('configInputFile') !== null && !empty($_FILES['image_field']['name']))){
		    		
		    		$this->edicao->edic_img = $this->upload_image($this->edicao->edic_img_nm, 'edicoes',
		    		 null, null, 3543, 1181);
		    	
	    	}

    		$this->db->trans_start();
            try{
            	$email = $this->EmailDAO->consultarTudo($this->edicao->email->email_email)[0];
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
            }

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
