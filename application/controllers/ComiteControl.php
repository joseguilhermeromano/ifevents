<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ComiteControl extends PrincipalControl implements InterfaceControl{

    public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/ComiteDAO' );
            $this->load->Model('ComiteModel','comite');
    }

    public function cadastrar() {
        $data = array("title"=>"IFEvents - Novo Comitê",
                    "tituloh2" => "<h2><span class='fa fa-calendar-plus-o'></span><b> Novo Comitê</b></h2>");
        if (empty($this->input->post())){
            return $this->chamaView("form-comite", "organizador",$data, 1);
        }

        $this->setaValores();
        $data['comite'] = $this->comite;

        if($this->valida()){

            $this->db->trans_start();
            try{
                $this->ComiteDAO->inserir($this->comite);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'O Comitê foi cadastrado com sucesso!');
                unset($data['comite']);
            }else{
                $this->session->set_flashdata('error', 'Não foi possível cadastrar o novo Comitê!');
            }

        }

        $this->chamaView("form-comite", "organizador", $data, 1);
    }

    public function alterar($codigo){
        $this->comite = $this->ComiteDAO->consultarCodigo($codigo);
        $data = array("title"=>"IFEvents - Atualizar Comitê",
                "tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Atualizar Comitê</b></h2>",
                "comite" => $this->comite);
        if (empty($this->input->post())) {
            return $this->chamaView("form-comite", "organizador", $data, 1);
        }

        if($this->comite === null){
            $this->session->set_flashdata('error', 'Este Comitê não existe!');
            redirect('conferencia/consultar');
        }

        $this->setaValores();

        if($this->valida()){

            $this->db->trans_start();
            $this->ComiteDAO->alterar($this->comite);
            $this->db->trans_complete();
            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'O Comitê foi atualizado com sucesso!');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível atualizar o comitê!');
                $this->chamaView("form-conferencia", "organizador", $data, 1);
            }

        }
        redirect('comite/consultar');
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
            $array = array('comi_nm' => $busca);
        }
        $data['comites']=$this->ComiteDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->ComiteDAO->totalRegistros(), 'comite/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->ComiteDAO->totalRegistros();
        $data['title']="IFEvents - Comitês";
        $this->chamaView("comites", "organizador", $data, 1);
    }

    public function consultarParaSelect2(){
        $data = $this->ComiteDAO->consultarTudo(array('comi_nm' => $this->comite->input->post('term')));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function excluir($codigo) {
        if($codigo !== null){
            $this->db->trans_start();
            try{
                $this->ComiteDAO->excluir($codigo);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'O Comitê foi excluído com sucesso!');
            }
        }
        if($codigo === null || $this ->db->trans_status()==false ){
            $this->session->set_flashdata('error', 'Não foi possível excluir o Comitê!');
        }
        redirect('comite/consultar');
    }
    
    
    private function valida(){
            $this->form_validation->set_rules(	'denominacao', 'denominacao', 'trim|required|max_length[100]' );
            $this->form_validation->set_rules(	'descricao', 'Descrição', 'trim|required|max_length[500]' );
            return $this->form_validation->run();
    }

    private function setaValores(){
     	$this->comite->setNome($this->input->post('denominacao'));
     	$this->comite->setDescricao($this->input->post('descricao'));
     }


}
