<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class EixoTematicoControl extends PrincipalControl implements InterfaceControl{

	public function __construct(){
		parent::__construct();

		$this->load->Model( 'dao/ModalidadeTematicaDAO' );
		$this->load->Model( 'ModalidadeTematicaModel','areaTematica' );
	}

	public function cadastrar(){
		if (empty($this->areaTematica->input->post())){
    		$this->chamaView("form-area-tematica", "organizador",
            	array("title"=>"IFEvents - Novo Eixo Temático",
            		"tituloh2" => "<h2><span class='fa fa-plus'></span><b> Novo Eixo Temático</b></h2>"), 1);
    		return true;
    	}

    	$this->areaTematica->setaValores();
    	$this->areaTematica->valida();
    		

    	if($this->form_validation->run()){

    		$this->db->trans_start();
    			//pegar codigo da conferencia pela sessao (selecionada)
    			$this->areaTematica->mote_conf_cd = 1;
            	$this->areaTematica->mote_tipo = 1;
            	$this->ModalidadeTematicaDAO->inserir($this->areaTematica);
    		$this->db->trans_complete();

    		if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'O Eixo Temático foi cadastrado com sucesso!');
                $this->areaTematica = null;
            }else{
            	$this->session->set_flashdata('error', 'Não foi possível cadastrar o eixo temático!');
            }

    	}


    	$this->chamaView("form-area-tematica", "organizador",
            	array("title"=>"IFEvents - Novo Eixo Temático",
            	"tituloh2" => "<h2><span class='fa fa-plus'></span><b> Novo Eixo Temático</b></h2>",
            	 "areaTematica" => $this->areaTematica), 1);
	}

	public function alterar($codigo){
		$areaTematica = $this->ModalidadeTematicaDAO->consultarCodigo($codigo);
		if (empty($this->areaTematica->input->post()) && isset($codigo)) {
			$this->chamaView("form-area-tematica", "organizador",
            	array("title"=>"IFEvents - Editar Eixo Temático",
            		"tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Editar Eixo Temático</b></h2>",
            		"areaTematica" => $areaTematica), 1);
			return true;
		}

		$this->areaTematica->setaValores();
    	$this->areaTematica->valida();
    		

    	if($this->form_validation->run()){

    		$this->db->trans_start();
    			//pegar codigo da conferencia pela sessao (selecionada)
    			$this->areaTematica->mote_conf_cd = 1;
            	$this->areaTematica->mote_tipo = 1;
            	$this->ModalidadeTematicaDAO->alterar($this->areaTematica);
    		$this->db->trans_complete();

    		if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'O eixo temático foi atualizado com sucesso!');
                $this->areaTematica = null;
            }else{
            	$this->session->set_flashdata('error', 'Não foi possível atualizar o eixo temático!');
            }

    	}


    	redirect('eixo-tematico/consultar');
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
            $array = array('Modalidade_Tematica.mote_nm'=>$busca, 'Modalidade_Tematica.mote_tipo' => 1);
        }else{
            $busca=null;
            $array=array('mote_tipo'=>1);
        }

        $data['areasTematicas']=$this->ModalidadeTematicaDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->ModalidadeTematicaDAO->totalRegistros($conf_cd, 1), 'area-tematica/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->ModalidadeTematicaDAO->totalRegistros($conf_cd, 1);
        $data['title']="IFEvents - Eixos Temáticos";
        $this->chamaView("areas-tematicas", "organizador", $data, 1);
	}

	public function excluir($codigo){
		$this->areaTematica->mote_cd = $codigo;
		if($this->ModalidadeTematicaDAO->excluir($this->areaTematica)){
			$this->session->set_flashdata('success', 'O Eixo Temático foi excluído com sucesso!');
		}else{
			$this->session->set_flashdata('success', 'Não foi possível excluir o eixo temático!');
		}
		redirect('eixo-tematico/consultar');
	}

}