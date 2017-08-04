<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
	require_once 'PrincipalControl.php';
	require_once 'InterfaceControl.php';

	class InstituicaoControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();
			$this->load->Model( 'dao/InstituicaoDAO' );
			$this->load->Model('InstituicaoModel','instituicao');
		}

    public function cadastrar() {
      if (empty($this->instituicao->input->post())){
      	$this->chamaView("novainstituicao", "organizador",
				array("title"=>"IFEvents - Instituicao - Organizador"), 1);
        return true;
      }
			$this->instituicao->setNome($this->input->post("nome"));
			$this->instituicao->setAbreviacao($this->input->post("abreviacao"));
			$this->instituicao->setDescricao($this->input->post("descricao"));
      if( $this->instituicao->valida()==false){
      	$this->session->set_flashdata('error', 'Falta preencher alguns campos!');
      }
      else{
      	$this->instituicao->setaValores();
        if($this->InstituicaoDAO->inserir($this->instituicao)==true){
        	$this->session->set_flashdata('success', 'Instituição cadastrada com sucesso!');
        }else{
        	$this->session->set_flashdata('error', 'Instituição não cadastrada!');
        }
      }
			$this->chamaView("novainstituicao", "organizador",
			array("title"=>"IFEvents - Instituicao - Organizador"), 1);
    }

    public function alterar($codigo) {
			$data['instituicao'] = $this->InstituicaoDAO->consultarCodigo($codigo);
      if(!empty($this->input->post())){
				$this->chamaView("edita-instituicao", "organizador",
				array("title"=>"IFEvents - Instituicao", "organizador"), $data, 1);
				$this->instituicao->setCodigo($this->input->post('codigo'));
				$this->instituicao->setNome($this->input->post("nome"));
				$this->instituicao->setAbreviacao($this->input->post("abreviacao"));
				$this->instituicao->setDescricao($this->input->post("descricao"));
        $this->instituicao->setaValores();
        if( $this->instituicao->valida()==false){
        	$this->session->set_flashdata('error', 'Falta preencher alguns campos!');
        }
        else{
        	if($this->InstituicaoDAO->alterar($this->instituicao)==true){
          	$this->session->set_flashdata('success', 'O Instituição atualizada com sucesso!');
            redirect('instituicao/consultarTudo/');
          }else{
          	$this->session->set_flashdata('error', 'Não foi possível atualizar a instituição!');
          }
        }
      }
      $this->chamaView("edita-instituicao", "organizador", $data, 1);
		}

    public function consultarParaSelect2(){
    	$data = $this->InstituicaoDAO->consultarPorNomeOuAbreviacao($this->instituicao->input->post('term'));
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

    public function consultar() {
        $limite = 10;
        $numPagina =0;
        $busca=null;
        $array=null;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }
        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('inst_nm' => $busca, 'inst_abrev' => $busca);
        }
        $data['instituicoes']=$this->InstituicaoDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->InstituicaoDAO->totalRegistros(), 'instituicao/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->InstituicaoDAO->totalRegistros();
        $data['title']="IFEvents - Instituições";
        $this->chamaView("instituicoes", "organizador", $data, 1);
    }

    public function excluir($codigo) {
        if( $this->InstituicaoDAO->excluir($this->uri->segment(3)) == false){
            $this->session->set_flashdata('error', 'Instituicao não pode ser excluida!');
        }else{
            $this->session->set_flashdata('success', 'Instituição deletada com sucesso!');
            redirect('instituicao/consultarTudo/');
        }
    }
}
