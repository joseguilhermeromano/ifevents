<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
	require_once 'PrincipalControl.php';
	require_once 'InterfaceControl.php';
class ConferenciaControl extends PrincipalControl implements InterfaceControl{

    public function __construct(){
            parent::__construct();
            $this->load->Model( 'dao/ConferenciaDAO' );
            $this->load->Model('ConferenciaModel','conferencia');

    }

    public function cadastrar() {
    	$data = array("title"=>"IFEvents - Nova Conferência"
            ,"tituloh2" => "<h2><span class='fa fa-calendar-plus-o'></span><b> Nova Conferência</b></h2>");
        if (empty($this->conferencia->input->post())){
            return $this->chamaView("form-conferencia", "organizador",$data, 1);
        }

        $this->setaValores();
        $data['conferencia'] = $this->conferencia;

        if($this->valida()){

            $this->db->trans_start();
            try{
                $this->ConferenciaDAO->inserir($this->conferencia);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A Conferência foi cadastrada com sucesso!');
                unset($data['conferencia']);
            }else{
                $this->session->set_flashdata('error', 'Não foi possível cadastrar a nova conferência!');
            }

        }

        $this->chamaView("form-conferencia", "organizador", $data, 1);
    }

    public function listaconferencia(){
    	$this->chamaView("listaconferencia", "organizador",
      array("title"=>"IFEvents - Nova Conferencia - Organizador"), 1);
    }

    public function alterar($codigo){
        $this->conferencia = $this->ConferenciaDAO->consultarCodigo($codigo);
        $data = array("title"=>"IFEvents - Editar Conferência",
                "tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Atualizar Conferência</b></h2>",
                "conferencia" => $this->conferencia);
        if (empty($this->input->post())) {
            return $this->chamaView("form-conferencia", "organizador", $data, 1);
        }

        if($this->conferencia === null){
            $this->session->set_flashdata('error', 'Esta conferência não existe!');
            redirect('conferencia/consultar');
        }

        $this->setaValores();

        if($this->valida()){

            $this->db->trans_start();
            $this->ConferenciaDAO->alterar($this->conferencia);
            $this->db->trans_complete();
            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A Conferência foi atualizada com sucesso!');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível atualizar a conferência!');
                $this->chamaView("form-conferencia", "organizador", $data, 1);
            }

        }
        redirect('conferencia/consultar');
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
            $array = array('conf_nm' => $busca, 'conf_abrev' => $busca);
        }
        $data['content']=$this->ConferenciaDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->ConferenciaDAO->totalRegistros(), 'conferencia/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->ConferenciaDAO->totalRegistros();
        $data['title']="IFEvents - Conferências";
        $this->chamaView("conferencias", "organizador", $data, 1);
    }

    public function excluir($codigo) {
        if($codigo !== null){
            $this->db->trans_start();
            try{
                $this->ConferenciaDAO->excluir($codigo);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A Conferência foi excluída com sucesso!');
            }
        }
        if($codigo === null || $this ->db->trans_status()==false ){
            $this->session->set_flashdata('error', 'Não foi possível excluir o registro de Conferência!');
        }
        redirect('conferencia/consultar');
    }

    public function consultarParaSelect2(){
    	$data = $this->ConferenciaDAO->consultarPorNomeOuAbreviacao($this->conferencia->input->post('term'));
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    private function valida(){
            $this->form_validation->set_rules(	'titulo', 'Título', 'trim|required|max_length[100]' );
            $this->form_validation->set_rules(	'abreviacao', 'Abreviação', 'trim|required|max_length[50]' );
            $this->form_validation->set_rules(	'descricao', 'Descrição', 'trim|required|max_length[500]' );
            return $this->form_validation->run();
    }

    private function setaValores(){
     	$this->conferencia->setTitulo($this->input->post('titulo'));
     	$this->conferencia->setAbreviacao(
            strtoupper($this->input->post('abreviacao'))
        );
     	$this->conferencia->setDescricao($this->input->post('descricao'));
     }
}
