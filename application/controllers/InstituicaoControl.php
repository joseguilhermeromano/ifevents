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
        $data = array("title"=>"IFEvents - Nova Instituição",
                    "tituloh2" => "<h2><span class='fa fa-calendar-plus-o'></span><b> Nova Instituição</b></h2>");
        if (empty($this->input->post())){
            return $this->chamaView("form-instituicao", "organizador",$data, 1);
        }

        $this->setaValores();
        $data['instituicao'] = $this->instituicao;

        if($this->valida()){

            $this->db->trans_start();
            try{
                $this->InstituicaoDAO->inserir($this->instituicao);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A Instituição foi cadastrada com sucesso!');
                unset($data['instituicao']);
            }else{
                $this->session->set_flashdata('error', 'Não foi possível cadastrar a nova instituição!');
            }

        }

        $this->chamaView("form-instituicao", "organizador", $data, 1);
    }

    public function alterar($codigo){
        $this->instituicao = $this->InstituicaoDAO->consultarCodigo($codigo);
        $data = array("title"=>"IFEvents - Atualizar Instituição",
                "tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Atualizar Instituição</b></h2>",
                "instituicao" => $this->instituicao);
        if (empty($this->input->post())) {
            return $this->chamaView("form-instituicao", "organizador", $data, 1);
        }

        if($this->instituicao === null){
            $this->session->set_flashdata('error', 'Esta Instituição não existe!');
            redirect('instituicao/consultar');
        }

        $this->setaValores();

        if($this->valida()){

            $this->db->trans_start();
            $this->InstituicaoDAO->alterar($this->instituicao);
            $this->db->trans_complete();
            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A Instituição foi atualizada com sucesso!');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível atualizar a instituição!');
                $this->chamaView("form-instituicao", "organizador", $data, 1);
            }

        }
        redirect('instituicao/consultar');
    }
        
    public function consultarParaSelect2(){
    	$data = $this->InstituicaoDAO->consultarPorNomeOuAbreviacao($this->instituicao->input->post('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function consultar() {
        $getLimiteReg = $this->input->get('limitereg');
        $limite = $getLimiteReg !== null ? $getLimiteReg : 10;
        $getPagina = $this->input->get('pagina');
        $numPagina = $getPagina !== null ? $getPagina : 0;
        $busca=null;
        $array= null;
        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('inst_nm' => $busca, 'inst_abrev' => $busca);
        }
        $consulta = $this->InstituicaoDAO->consultarTudo($array, $limite, $numPagina);
        $totalRegConsulta = count($this->InstituicaoDAO->consultarTudo($array));
        $totalRegTabela = $this->InstituicaoDAO->totalRegistros();
        $totalRegistros = !empty($busca) ? $totalRegConsulta : $totalRegTabela;
        $hrefPaginacao = 'instituicao/consultar/?busca='.$busca.'&limitereg='.$limite;
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, $hrefPaginacao);
        $data['instituicoes']= $consulta;
        $data['busca']= $busca;
        $data['limiteReg']= $limite;
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Instituições";
        $this->chamaView("instituicoes", "organizador", $data, 1);
    }

    public function excluir($codigo) {
        if($codigo !== null){
            $this->db->trans_start();
            try{
                $this->InstituicaoDAO->excluir($codigo);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A instiuição foi excluída com sucesso!');
            }
        }
        if($codigo === null || $this ->db->trans_status()==false ){
            $this->session->set_flashdata('error', 'Não foi possível excluir a Instituição!');
        }
        redirect('instituicao/consultar');
    }
    
    private function valida(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]' );
        $this->form_validation->set_rules('abreviacao', 'Abreviação', 'trim|required|max_length[100]' );
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|max_length[500]' );
        return $this->form_validation->run();
    }

    private function setaValores(){
     	$this->instituicao->setNome($this->input->post('nome'));
        $abreviacao = strtoupper($this->input->post('abreviacao'));
        $this->instituicao->setAbreviacao($abreviacao);
        $this->instituicao->setLogo($this->obtemImagem());
     	$this->instituicao->setDescricao($this->input->post('descricao'));
    }
    
    private function obtemImagem(){
        $ExisteLinkTemp = $this->input->post('link_imagem_salva');
        $inputImagemCarregada = $_FILES['image_field']['name'];
        
        
        if($ExisteLinkTemp == null && $inputImagemCarregada == null){
            $this->form_validation->set_rules( 'image_field', 'Logo da Instituição', 'required' );
            return null;
        }
            
        if($inputImagemCarregada != null){
            $ExisteLinkTemp = $this->upload_arquivo('image_field', 'temp/', $this->geraNomeLogo());
            $this->session->set_flashdata('imagem_temp',$ExisteLinkTemp);
        }
        
        if($this->valida()==true){
            return $this->salvaImagemDefinitivo($ExisteLinkTemp);
        }
        
        return $ExisteLinkTemp;
    }
    
    private function salvaImagemDefinitivo($linkTemporario){
        $nomeImagem = $this->geraNomeLogo();
        $extensaoArquivo = strrchr($linkTemporario, '.');
        $novoLink = 'application/views/imagens/instituicoes/'.$nomeImagem;
        $novoLink .= $extensaoArquivo;
        rename($linkTemporario,$novoLink);
        return $novoLink;
    }

    private function geraNomeLogo(){
        $nomeImagem = "logo_";
        $nomeImagem .= strtolower($this->instituicao->getAbreviacao());
        return $nomeImagem;
    }
    
    public function resgataImagem(){
        $link = $this->input->post('link');
        $data = $this->configInputImagem();
        if($link !== ''){
            $data = $this->PreviewImagem($data, $link);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    private function configInputImagem(){
        return $configPlugin = array(
             "language" => "pt-BR"
            ,"theme" => "fa"
            ,"showUpload" => false
            ,"overwriteInitial" => true
            ,"maxFileSize"=> 4096
            ,"allowedFileExtensions" => array("jpg", "png", "jpeg", "gif") 
            ,"priviewFileType" => "any"
            ,"browseClass"=> "btn btn-success"
            ,"browseIcon" => "<i class='glyphicon glyphicon-picture'></i>"
            ,"maxImageWidth" => 250
            ,"maxImageHeight" => 150
        );
    }
    
    private function PreviewImagem($array, $linkArquivo){
        if($linkArquivo!==null){
            $array['initialPreview'] = base_url($linkArquivo);
            $array['initialPreviewAsData'] = true;
            $array['initialPreviewConfig'] = array(array(
            "caption" => basename($linkArquivo)
            , "size" => filesize($linkArquivo)
            , "showDelete" => false
            , "showZoom" => true));  
        }
        return $array;
    }
}
