<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
        
include_once 'PrincipalControl.php';

class SubmissaoControl extends PrincipalControl{
    
    private $linkTempArqSemIdent;
    private $linkTempArqComIdent;
    private $codigoArtigo;
    
    function SubmissaoControl(){
        parent::__construct();
        $this->load->model('SubmissaoModel', 'submissao');
        $this->load->model('dao/SubmissaoDAO');
        $this->load->model('dao/ArtigoDAO');    
    }
    
    public function cadastrar($codigoArtigo){
        $this->codigoArtigo = $codigoArtigo;
        if(!empty($this->input->post())){
            $this->setaValores();
            if($this->valida()){
                $this->db->trans_start();
                    $this->SubmissaoDAO->inserir($this->submissao);
                $this->db->trans_complete();
                if($this ->db->trans_status() === TRUE){
                    $this->session->set_flashdata('success', 'O seu trabalho foi submetido com sucesso!');
                    redirect('artigo/consultar');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível submeter o seu trabalho!');
                }
            }
        }
        $data['linkArqSemIdent'] = $this->linkTempArqSemIdent;
        $data['linkArqComIdent'] = $this->linkTempArqComIdent;
        $data['title'] = 'IFEvents - Submeter Trabalho';
        $data['tituloh2'] = "<h2><span class='glyphicon glyphicon-open-file'></span>"
                . "<b> Submeter Trabalho</b></h2>";
        return $this->chamaView("form-submissao", "participante", $data, 1);
    }
    
    public function alterar($codigoArtigo) {
        $this->codigoArtigo = $codigoArtigo;
        $this->submissao = $this->SubmissaoDAO
            ->consultarUltimaSubmissao($codigoArtigo);
        if($this->submissao === null){
            redirect('submissao/cadastrar/'.$codigoArtigo);
        }
        $this->resgataArtigos();
        if(!empty($this->input->post())){
            $this->setaValores();
            if($this->valida()){
                $this->db->trans_start();
                    $this->SubmissaoDAO->alterar($this->submissao);
                $this->db->trans_complete();
                if($this ->db->trans_status() === TRUE){
                    $this->session->set_flashdata('success', 'O seu trabalho foi atualizado com sucesso!');
                    redirect('artigo/consultar');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível atualizar o seu trabalho!');
                }
            }
        }
        $data['linkArqSemIdent'] = $this->linkTempArqSemIdent;
        $data['linkArqComIdent'] = $this->linkTempArqComIdent;
        $data['title'] = 'IFEvents - Atualizar Submissão';
        $data['tituloh2'] = "<h2><span class='fa fa-file'></span><b> Atualizar Submissão</b></h2>";
        return $this->chamaView("form-submissao", "participante", $data, 1);
    }
    
    private function setaValores(){
        $versaoSubm = $this->SubmissaoDAO->totalRegistros($this->codigoArtigo) + 1;
        $artigo = $this->ArtigoDAO->consultarCodigo($this->codigoArtigo);
        $this->submissao->setArtigo($artigo);
        $this->submissao->setVersao($versaoSubm);
        $this->submissao->setData(date("y-m-d"));
        $this->submissao->setHora(date("H:i"));
        $this->linkTempArqSemIdent = $this->obtemLinkTempArtigo('linkArqSemIdent', 'arqsemident');
        $this->linkTempArqComIdent = $this->obtemLinkTempArtigo('linkArqComIdent', 'arqcomident');
        $nomeArqSemIdent = basename($this->linkTempArqSemIdent);
        $this->submissao->setNomeArqSemIdent($nomeArqSemIdent);
        $nomeArqComIdent = basename($this->linkTempArqComIdent);
        $this->submissao->setNomeArqComIdent($nomeArqComIdent);
        $arqSemIdent = $this->obtemMediumBlobArtigo($this->linkTempArqSemIdent);
        $this->submissao->setArqSemIdent($arqSemIdent);
        $arqComIdent = $this->obtemMediumBlobArtigo($this->linkTempArqComIdent);
        $this->submissao->setArqComIdent($arqComIdent);
    }
    
    private function valida(){
        $inputArqSemIdent = $_FILES['arqsemident']['name'];
        $inputArqComIdent = $_FILES['arqcomident']['name'];
        if(empty($inputArqSemIdent)&& empty($this->linkTempArqSemIdent)){
            $this->form_validation->set_rules( 'arqsemident', 
                    'Selecionar trabalho sem identificação', 'required' );
            return $this->form_validation->run();
        }
        if(empty($inputArqComIdent) && empty($this->linkTempArqSemIdent)){
            $this->form_validation->set_rules( 'arqcomident', 
            'Selecionar trabalho com identificação', 'required' );
            return $this->form_validation->run();
        }
        return true;
    }
    
    private function obtemMediumBlobArtigo($linkTemp){
        $arquivo = file_get_contents($linkTemp);
        return $arquivo;
    }
    
    private function obtemLinkTempArtigo($inputLinkTemp, $inputFile){
        $linkTemp = $this->input->post($inputLinkTemp);
        $artigoCarregado = $_FILES[$inputFile]['name'];
        
        if(!empty($artigoCarregado)){
            echo 'artigo carregado:'.$artigoCarregado;
            return $this->upload_arquivo($inputFile, 'temp/');
        }
        
        if(!empty($linkTemp)){
            return $linkTemp;
        }
        
        return null;
    }
    
    public function obtemDadosArtigo(){
       $link = $this->input->post('link');
        $data = $this->configInput();
        if($link !== ''){
            $data = $this->PreviewInput($data, $link);
        }
        $json = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json);
    }
    
    private function resgataArtigos(){
        $linkArqSemIdent = "temp/".$this->submissao->getNomeArqSemIdent();
        $arqSemIdent = fopen($linkArqSemIdent,"w");
        fwrite($arqSemIdent,$this->submissao->getArqSemIdent());
        fclose($arqSemIdent);
        $linkArqComIdent = "temp/".$this->submissao->getNomeArqComIdent();
        $arqComIdent = fopen($linkArqComIdent,"w");
        fwrite($arqComIdent,$this->submissao->getArqComIdent());
        fclose($arqComIdent);
        $this->linkTempArqSemIdent = $linkArqSemIdent;
        $this->linkTempArqComIdent = $linkArqComIdent;
    }
    
    public function visualizarArtigoSemIdent($codigoSubmissao){
        $this->submissao = $this->SubmissaoDAO->consultarCodigo($codigoSubmissao);
        $nomeArquivo = $this->submissao->getNomeArqSemIdent();
        $arquivo = $this->submissao->getArqSemIdent();
        return $this->visualiza_arquivo($nomeArquivo, $arquivo);
    }
    
    public function visualizarArtigoComIdent($codigoSubmissao){
        $this->submissao = $this->SubmissaoDAO->consultarCodigo($codigoSubmissao);
        $nomeArquivo = $this->submissao->getNomeArqComIdent();
        $arquivo = $this->submissao->getArqComIdent();
        return $this->visualiza_arquivo($nomeArquivo, $arquivo);
    }
    
    private function configInput(){
        return $configPlugin = array(
             "language" => "pt-BR"
            ,"theme" => 'explorer'
            , "hideThumbnailContent" => true
            ,"showUpload" => false
            ,"overwriteInitial" => true
            ,"maxFileSize"=> 4096
            ,"allowedFileExtensions" => array("pdf", "doc", "docx", "txt") 
            ,"allowedPreviewTypes" => array("doc", "docx", "pdf","text")
            ,"browseClass"=> "btn btn-success"
            ,"browseIcon" => "<i class='fa fa-file'></i>"
        );
    }
    
    private function PreviewInput($array, $link){
        $ext = str_replace('.','',strrchr($link, '.'));
        $array['initialPreview'] = base_url($link);
        $array['initialPreviewAsData'] = true ;
        $array['initialPreviewConfig'] = array(array(
         "caption" => basename($link)
        , "type" => $ext == 'pdf' ? $ext : 'text'
        , "size" => filesize($link)
        , "showDelete" => false
        , "showZoom" =>  $ext == 'pdf' ? true : false));
        $array['preferIconicPreview'] = true;
        $array['previewFileIconSettings'] = array(
             "pdf" => '<i class="fa fa-file-pdf-o text-danger"></i>'
            ,"doc" => '<i class="fa fa-file-word-o text-primary"></i>'
            ,"txt" => '<i class="fa fa-file-text-o text-info"></i>'
        );
        $array['previewFileExtSettings'] = array();
        return $array;
    }
    
    public function downloadArtigoSemIdent($codigoSubmissao){
        $submissao = $this->SubmissaoDAO->consultarCodigo($codigoSubmissao);
        return $this->download_arquivo($submissao->getNomeArqSemIdent()
                ,$submissao->getArqSemIdent());
    }
    
    public function downloadArtigoComIdent($codigoSubmissao){
        $submissao = $this->SubmissaoDAO->consultarCodigo($codigoSubmissao);
        return $this->download_arquivo($submissao->getNomeArqSemIdent()
                ,$submissao->getArqSemIdent());
    }
    
}

