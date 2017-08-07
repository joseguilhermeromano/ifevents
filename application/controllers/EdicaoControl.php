<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class EdicaoControl extends PrincipalControl implements InterfaceControl{
    

    public function __construct(){
        parent::__construct();

        $this->load->Model( 'dao/EdicaoDAO' );
        $this->load->Model( 'dao/ConferenciaDAO' );
        $this->load->Model( 'dao/ComiteDAO' );
        $this->load->Model( 'dao/InstituicaoDAO' );
        $this->load->Model( 'EdicaoModel','edicao' );
        $this->load->helper('html');
    }

    public function cadastrar(){
        $data = array("title"=>"IFEvents - Nova Edição",
                    "tituloh2" => "<h2><span class='fa fa-calendar-plus-o'></span><b> Nova Edição</b></h2>");
        if (empty($this->edicao->input->post())){
            return $this->chamaView("form-edicao", "organizador",$data, 1);
        }

        $this->setaValores();
        $data['edicao'] = $this->edicao;

        if($this->valida()){

            $this->db->trans_start();
            try{
                $this->EdicaoDAO->inserir($this->edicao);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A Edição foi cadastrada com sucesso!');
                unset($data['edicao']);
            }else{
                $this->session->set_flashdata('error', 'Não foi possível cadastrar a nova edição!');
            }

        }

        $this->chamaView("form-edicao", "organizador", $data, 1);
    }

    private function setaValores(){        
        $this->edicao->setTema($this->input->post("tema"));
        $codigoConferencia = $this->input->post('conferencia');
        $conferencia = $this->ConferenciaDAO->consultarCodigo($codigoConferencia);
        $this->edicao->setConferencia($conferencia);
        $this->edicao->setNumeroEdicao($this->geraNumeracaoEdicao($codigoConferencia));
        $codigoComite = $this->input->post('comite');
        $comite = $this->ComiteDAO->consultarCodigo($codigoComite);
        $this->edicao->setComite($comite); 
        $this->edicao->setLinkEdicao(str_replace(base_url(),'', $this->input->post('linkevento')));
        $this->edicao->setImagemEdicao($this->obtemImagem());
        $this->edicao->setApresentacao($this->input->post('apresentacao'));
        $this->edicao->setParcerias($this->resgataParcerias());
        $this->edicao->setEmail($this->input->post('email'));
        $this->edicao->setTelefone($this->input->post('telefone'));
        $this->edicao->setDataInicioEvento($this->input->post('datainicioevento'));
        $this->edicao->setDataFimEvento($this->input->post('datafimevento'));
        $this->edicao->setDataInicioPublicacao($this->input->post('datainiciopub'));
        $this->edicao->setDataFimPublicacao($this->input->post('datafimpub'));
        $this->edicao->setDataInicioInscricao($this->input->post('datainicioinsc'));
        $this->edicao->setDataFimInscricao($this->input->post('datafiminsc'));
        $this->edicao->setCep($this->input->post('cep'));
        $this->edicao->setLogradouro($this->input->post('logradouro'));
        $this->edicao->setBairro($this->input->post('bairro'));
        $this->edicao->setNumero($this->input->post('numero'));
        $this->edicao->setComplemento($this->input->post('complemento'));
        $this->edicao->setCidade($this->input->post('cidade'));
        $this->edicao->setUf($this->input->post('uf'));
    }

    private function valida(){
        $this->form_validation->set_rules( 'conferencia', 'Conferência', 'trim|required|max_length[11]' );
        $this->form_validation->set_rules( 'comite', 'Comitê', 'trim|required|max_length[11]' );
        $this->form_validation->set_rules( 'tema', 'Tema da Edição', 'trim|required|max_length[100]' );
        $this->form_validation->set_rules( 'linkevento', 'Link do Evento', 
            'valid_url|trim|required|max_length[100]' );
        $this->form_validation->set_rules( 'apresentacao', 'Apresentação', 'trim|required' );
        $this->form_validation->set_rules( 'parcerias[]', 'Parcerias', 'trim|required' );
        $this->form_validation->set_rules( 'logradouro', 'Logradouro', 'required|trim|max_length[200]' );
        $this->form_validation->set_rules( 'bairro', 'Bairro', 'required|trim|max_length[100]' );
        $this->form_validation->set_rules( 'cep', 'CEP', 'required|valid_cep' );
        $this->form_validation->set_rules( 'cidade', 'Cidade', 'required|trim|max_length[100]' );
        $this->form_validation->set_rules( 'uf', 'UF', 'required|trim|max_length[2]' );
        $this->form_validation->set_rules( 'numero', 'Número', 'trim|required|max_length[9]' );
        $this->form_validation->set_rules( 'complemento', 'Complemento', 'trim|max_length[100]' );
        $this->form_validation->set_rules( 'email', 'E-mail', 'valid_email|trim|required|max_length[100]' );
        return $this->form_validation->run();
    }
    
    public function consultarAnaisResultados($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        $data['anais'] = $this->configPlugin();
        $data['anais']['deleteUrl'] = base_url('edicao/file-delete-anais/').$codigoEdicao;
        $data['anais']['uploadUrl'] = base_url('edicao/file-upload-anais/').$codigoEdicao;
        $data['resultados'] = $this->configPlugin();
        $data['resultados']['deleteUrl'] = base_url('edicao/file-delete-resultados/').$codigoEdicao;
        $data['resultados']['uploadUrl'] = base_url('edicao/file-upload-resultados/').$codigoEdicao;
        $linkAnais = $this->edicao->getAnais();
        $linkResultados = $this->edicao->getResultados();
        $data['anais'] = $this->PreviewInputFile($data['anais'],$linkAnais);
        $data['resultados'] = $this->PreviewInputFile($data['resultados'],$linkResultados); 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    
    
    private function configPlugin(){
        return $configPlugin = array(
             "language" => "pt-BR"
            ,"theme" => "fa"
            ,"showUpload" => true
            ,"overwriteInitial" => true
            ,"maxFileSize"=> 4096
            ,"allowedFileExtensions" => array("pdf", "docx") 
            ,"priviewFileType" => "any"
            ,"browseClass"=> "btn btn-success"
            ,"browseIcon" => '<i class="fa fa-file"></i>' 
        );
    }
    
    private function PreviewInputFile($array, $linkArquivo){
        if($linkArquivo!==null){
            $array['initialPreview'] = base_url($linkArquivo);
            $array['initialPreviewAsData'] = true;
            $array['initialPreviewConfig'] = array(array(
            "type" => 'pdf'
            ,"caption" => basename($linkArquivo)
            , "size" => filesize($linkArquivo)
            , "showDelete" => true
            , "showZoom" => true));  
        }
        return $array;
    }
    
    public function uploadFileAnais($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $novoNomeArquivo = 'anais_'.$this->edicao->getNumeroEdicao().'_';
        $novoNomeArquivo .= strtolower($this->edicao->getConferencia()->getAbreviacao());
        $diretorio = 'application/views/arquivos/edicoes/anais/';
        $linkArquivo = $this->upload_arquivo('arquivo_anais',$diretorio,$novoNomeArquivo);
        if($linkArquivo === null){
            $data['error'] = $this->session->flashdata('error');
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->edicao->setAnais($linkArquivo);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarAnaisResultados($codigoEdicao);
    }
    
    public function deleteFileAnais($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        unlink($this->edicao->getAnais());
        $this->edicao->setAnais(null);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarAnaisResultados($codigoEdicao);
    }
    
    public function uploadFileResultados($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $novoNomeArquivo = 'resultados_'.$this->edicao->getNumeroEdicao().'_';
        $novoNomeArquivo .= strtolower($this->edicao->getConferencia()->getAbreviacao());
        $diretorio = 'application/views/arquivos/edicoes/resultados/';
        $linkArquivo = $this->upload_arquivo('arquivo_resultados',$diretorio,$novoNomeArquivo);
        if($linkArquivo === null){
            $data['error'] = $this->session->flashdata('error');
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->edicao->setResultados($linkArquivo);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarAnaisResultados($codigoEdicao);
    }
    
    public function deleteFileResultados($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        unlink($this->edicao->getResultados());
        $this->edicao->setResultados(null);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarAnaisResultados($codigoEdicao);
    }
    
    
    public function consultarRegrasSubmissaoRevisao($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        $data['submissao'] = $this->configPlugin();
        $data['submissao']['deleteUrl'] = base_url('edicao/file-delete-submissao/').$codigoEdicao;
        $data['submissao']['uploadUrl'] = base_url('edicao/file-upload-submissao/').$codigoEdicao;
        $data['revisao'] = $this->configPlugin();
        $data['revisao']['deleteUrl'] = base_url('edicao/file-delete-revisao/').$codigoEdicao;
        $data['revisao']['uploadUrl'] = base_url('edicao/file-upload-revisao/').$codigoEdicao;
        $linkSubmissao = $this->edicao->getDiretrizesSubmissao();
        $linkRevisao = $this->edicao->getDiretrizesAvaliacao();
        $data['submissao'] = $this->PreviewInputFile($data['submissao'],$linkSubmissao);
        $data['revisao'] = $this->PreviewInputFile($data['revisao'],$linkRevisao); 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    public function uploadRegrasSubmissao($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $novoNomeArquivo = 'DireSubm_'.$this->edicao->getNumeroEdicao().'_';
        $novoNomeArquivo .= strtolower($this->edicao->getConferencia()->getAbreviacao());
        $diretorio = 'application/views/arquivos/edicoes/diretrizes/submissao/';
        $linkArquivo = $this->upload_arquivo('arquivo_submissao',$diretorio,$novoNomeArquivo);
        if($linkArquivo === null){
            $data['error'] = $this->session->flashdata('error');
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->edicao->setDiretrizesSubmissao($linkArquivo);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarRegrasSubmissaoRevisao($codigoEdicao);
    }
    
    public function deleteRegrasSubmissao($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        unlink($this->edicao->getDiretrizesSubmissao());
        $this->edicao->setDiretrizesSubmissao(null);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarRegrasSubmissaoRevisao($codigoEdicao);
    }
    
    public function uploadRegrasRevisao($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $novoNomeArquivo = 'DireRev_'.$this->edicao->getNumeroEdicao().'_';
        $novoNomeArquivo .= strtolower($this->edicao->getConferencia()->getAbreviacao());
        $diretorio = 'application/views/arquivos/edicoes/diretrizes/revisao/';
        $linkArquivo = $this->upload_arquivo('arquivo_revisao',$diretorio,$novoNomeArquivo);
        if($linkArquivo === null){
            $data['error'] = $this->session->flashdata('error');
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        $this->edicao->setDiretrizesAvaliacao($linkArquivo);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarRegrasSubmissaoRevisao($codigoEdicao);
    }
    
    public function deleteRegrasRevisao($codigoEdicao){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        if($this->edicao === null){
            $data['error'] = "A Edição informada não existe!";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
        unlink($this->edicao->getDiretrizesAvaliacao());
        $this->edicao->setDiretrizesAvaliacao(null);
        $this->EdicaoDAO->alterar($this->edicao);
        $this->consultarRegrasSubmissaoRevisao($codigoEdicao);
    }
    
    private function obtemImagem(){
        $ExisteLinkTemp = $this->input->post('link_imagem_salva');
        $inputImagemCarregada = $_FILES['image_field']['name'];
        
        if($ExisteLinkTemp == null && $inputImagemCarregada == null){
            $this->form_validation->set_rules( 'image_field', 'Imagem do Evento', 'required' );
            return null;
        }
            
        if($inputImagemCarregada != null){
            $ExisteLinkTemp = $this->upload_arquivo('image_field', 'temp/', $this->geraNomeImagemEdicao());
        }
        
        if($this->valida()==true){
            return $this->salvaImagemDefinitivo($ExisteLinkTemp);
        }
        
        return $ExisteLinkTemp;
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
            ,"maxImageWidth" => 3543
            ,"minImageWidth" => 960
            ,"maxImageHeight" => 1181
            ,"minImageHeight" => 602
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
    
    private function salvaImagemDefinitivo($linkTemporario){
        $nomeImagem = $this->geraNomeImagemEdicao();
        $extensaoArquivo = strrchr($linkTemporario, '.');
        $novoLink = 'application/views/imagens/edicoes/'.$nomeImagem;
        $novoLink .= $extensaoArquivo;
        rename($linkTemporario,$novoLink);
        return $novoLink;
    }

    private function geraNomeImagemEdicao(){
        $nomeImagem = "img_";
        $nomeImagem .= $this->edicao->getNumeroEdicao()."_";
        $nomeConferencia = $this->edicao->getConferencia()->getAbreviacao();
        $nomeImagem .= strtolower($nomeConferencia);
        return $nomeImagem;
    }

    private function geraNumeracaoEdicao($codigoConferencia){
        if($this->edicao->getNumeroEdicao()!==null){
            return $this->edicao->getNumeroEdicao();
        }
        return $this->EdicaoDAO->consultarUltimaEdicao($codigoConferencia) + 1;
    }

    public function geraLinkEdicao(){
        $codigoConferencia = $this->input->post('conf_cd');
        $linkEdicao = base_url("evento/").$this->geraNumeracaoEdicao($codigoConferencia);
        $linkEdicao .= "-";
        $nomeConferencia = $this->ConferenciaDAO->consultarCodigo($codigoConferencia)->getAbreviacao();
        $linkEdicao .= strtolower($nomeConferencia);
        $this->output->set_content_type('application/json')->set_output(json_encode($linkEdicao));
    }

    private function resgataParcerias(){
        $parceriasView = $this->input->post('parcerias');

        if($parceriasView !== null && !empty($parceriasView)){
            foreach ($parceriasView as $key => $value) {
                $parcerias[$key] = $this->InstituicaoDAO->consultarCodigo($value);
            }
            return $parcerias;
        }
        return null;
    }

    public function alterar($codigo){
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigo);
        $data = array("title"=>"IFEvents - Editar Edição",
                "tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Atualizar Edição</b></h2>",
                "edicao" => $this->edicao);
        if (empty($this->edicao->input->post())) {
            return $this->chamaView("form-edicao", "organizador", $data, 1);
        }

        if($this->edicao === null){
            $this->session->set_flashdata('error', 'Esta edição não existe!');
            redirect('edicao/consultar');
        }

        $this->setaValores();

        if($this->valida()){

            $this->db->trans_start();
            $this->EdicaoDAO->alterar($this->edicao);
            $this->db->trans_complete();
            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'A Edição foi atualizada com sucesso!');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível atualizar a edição!');
                $this->chamaView("form-edicao", "organizador", $data, 1);
            }

        }

        redirect('edicao/consultar');

    }

    public function excluir($codigo){

    }

    public function consultar(){
        $limite = 10;
        $numPagina =0;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }

        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $numEdicao = preg_replace("/\D/","", $busca);
            $busca =  preg_replace("/[^A-Za-z]/", "", $busca);
            $array = array('Conferencia.conf_abrev'=>$busca, 'edic_num'=> $numEdicao);
        }else{
            $busca=null;
            $array=null;
        }

        $data['edicoes']=$this->EdicaoDAO->consultarTudo($array, $limite, $numPagina);
        $data['paginacao'] = $this->geraPaginacao($limite, $this->EdicaoDAO->totalRegistros(), 'edicao/consultar/?busca='.$busca);
        $data['totalRegistros'] = $this->EdicaoDAO->totalRegistros();
        $data['title']="IFEvents - Edições";
        $this->chamaView("edicoes", "organizador", $data, 1);
    }

    
    public function atualizaRegras(){
        $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
        $this->edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
        $data['title']="IFEvents - Regras de Submissão de Trabalhos";
        $data['regra'] = $this->edicao;
        if(!empty($this->input->post())){
            $this->edicao->setDataInicioSubmissao($this->input->post('datainiciosubm'));
            $this->edicao->setDataFimSubmissao($this->input->post('datafimsubm'));
            $this->edicao->setDataInicioAvaliacao($this->input->post('datainiciorev'));
            $this->edicao->setDataFimAvaliacao($this->input->post('datafimrev'));

            $this->db->trans_start();
            $this->EdicaoDAO->alterar($this->edicao);
            $this->db->trans_complete();
            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'As Regras foram atualizadas com sucesso!');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível atualizar as regras!');
            }
        }
        $this->chamaView("regras-submissao", "organizador", $data ,1);
    }
    
    
    public function selecionarEvento($edicao){
        
        foreach ($this->session->userdata('eventos_recentes') as $key => $value) {
            if($value->edic_cd == $edicao){
                $this->session->set_userdata('evento_selecionado',$value);
            }
        }
        redirect('organizador/inicio');
    }

}
