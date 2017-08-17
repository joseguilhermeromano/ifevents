<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ModalidadeControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/ModalidadeTematicaDAO' );
		$this->load->Model( 'ModalidadeTematicaModel','modalidade' );
	}

	public function cadastrar(){
		if (empty($this->modalidade->input->post())){
    		$this->chamaView("form-modalidade", "organizador",
            	array("title"=>"IFEvents - Nova Modalidade",
            		"tituloh2" => "<h2><span class='fa fa-plus'></span><b> Nova Modalidade</b></h2>"), 1);
    		return true;
    	}

    	$this->modalidade->setaValores();
    	$this->modalidade->valida();
    		

    	if($this->form_validation->run()){

    		$this->db->trans_start();
                $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
            	$this->modalidade->mote_edic_cd = $codigoEdicao; 
            	$this->modalidade->mote_tipo = 0;
            	$this->ModalidadeTematicaDAO->inserir($this->modalidade);
    		$this->db->trans_complete();

    		if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'A Modalidade foi cadastrada com sucesso!');
                $this->modalidade = null;
            }else{
            	$this->session->set_flashdata('error', 'Não foi possível cadastrar a modalidade!');
            }

    	}


    	$this->chamaView("form-modalidade", "organizador",
            	array("title"=>"IFEvents - Nova Modalidade",
            	 "tituloh2" => "<h2><span class='fa fa-plus'></span><b> Nova Modalidade</b></h2>",
            	 "modalidade" => $this->modalidade), 1);
	}

	public function alterar($codigo){
		$modalidade = $this->ModalidadeTematicaDAO->consultarCodigo($codigo);
		if (empty($this->modalidade->input->post()) && isset($codigo)) {
			$this->chamaView("form-modalidade", "organizador",
            	array("title"=>"IFEvents - Editar Modalidade",
            		"tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Editar Modalidade</b></h2>",
            		"modalidade" => $modalidade), 1);
			return true;
		}

		$this->modalidade->setaValores();
    	$this->modalidade->valida();
    		

    	if($this->form_validation->run()){

                $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
            	$this->modalidade->mote_edic_cd = $codigoEdicao; 
            	$this->modalidade->mote_tipo = 1;
            	$this->ModalidadeTematicaDAO->alterar($this->modalidade);
    		$this->db->trans_complete();

    		if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'A Modalidade foi atualizada com sucesso!');
                $this->modalidade = null;
            }else{
            	$this->session->set_flashdata('error', 'Não foi possível atualizar a modalidade!');
            }

    	}


    	redirect('modalidade/consultar');
	}

	public function consultar(){
	$limite = 10;
        $numPagina =0; 
        $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }

        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('mote_nm'=>$busca
                    , 'mote_tipo' => '0'
                    , 'mote_edic_cd' => $codigoEdicao);
        }else{
            $busca=null;
            $array=array('mote_tipo'=>0
                ,'mote_edic_cd' => $codigoEdicao);
        }
        

        $data['modalidades']=$this->ModalidadeTematicaDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->ModalidadeTematicaDAO->totalRegistros($codigoEdicao, 0), 'modalidade/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->ModalidadeTematicaDAO->totalRegistros($codigoEdicao, 0);
         $data['title']="IFEvents - Modalidades";
        $this->chamaView("modalidades", "organizador", $data ,1);
	}

	public function excluir($codigo){
		$this->modalidade->mote_cd = $codigo;
		if($this->ModalidadeTematicaDAO->excluir($this->modalidade)){
			$this->session->set_flashdata('success', 'A Modalidade foi excluída com sucesso!');
		}else{
			$this->session->set_flashdata('success', 'Não foi possível excluir a modalidade!');
		}
		redirect('modalidade/consultar');
	}

}