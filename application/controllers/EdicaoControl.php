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
        $this->load->Model( 'dao/ModalidadeTematicaDAO' );
        $this->load->Model( 'EdicaoModel','edicao' );
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
    
    
    private function upload_imagem(){
        $this->LimparPastaTemp();
        $this->img->upload($_FILES['image_field'],'pt_BR');
        if (!$this->img->uploaded) {
            $this->session->set_flashdata('error', $this->img->error);
            return null;
        }
        if($this->img->file_is_image == false){
            $this->session->set_flashdata('error', 'O Arquivo selecionado não é uma imagem!');
            return null;
        }    
        $this->img->image_max_width = 3544;
        $this->img->image_max_height = 1182;
        $this->img->image_min_width = 3543;
        $this->img->image_min_height = 1181;
        $this->img->allowed = array('image/jpg','image/jpeg','image/png', 'image/bmp');
        $this->img->file_overwrite = true ;
        $this->img->Process("temp/");
        if ($this->img->processed) {
            $linkImg = str_replace("\\", "", $this->img->file_dst_pathname);
            return $linkImg;
        }
        $this->session->set_flashdata('error', $this->img->error);
        return null;
    }
    
    private function obtemImagem(){
        $ExisteLinkTemp = $this->input->post('link_imagem_salva');
        $inputImagemCarregada = $_FILES['image_field']['name'];
        
        if($ExisteLinkTemp == null && $inputImagemCarregada == null){
            $this->form_validation->set_rules( 'image_field', 'Imagem do Evento', 'required' );
            return null;
        }
            
        if($inputImagemCarregada != null){
            $ExisteLinkTemp = $this->upload_imagem();
        }
        
        if($this->valida()==true){
            return $this->salvaImagemDefinitivo($ExisteLinkTemp);
        }
        
        return $ExisteLinkTemp;
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
            $nomeConferencia = $this->edicao->getConferencia()->conf_abrev;
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
            $nomeConferencia = $this->ConferenciaDAO->consultarCodigo($codigoConferencia)->conf_abrev;
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
            $edicao = $this->EdicaoDAO->consultarCodigo($codigo);
            $data = array("title"=>"IFEvents - Editar Edição",
                    "tituloh2" => "<h2><span class='glyphicon glyphicon-pencil'></span><b> Atualizar Edição</b></h2>",
                    "edicao" => $edicao);
            if (empty($this->edicao->input->post())) {
                return $this->chamaView("form-edicao", "organizador", $data, 1);
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

    public function revisores(){
        $limite = 10;
        $numPagina =0;
        $conf_cd = 1;
        if(null !== $this->input->get('pagina')){
            $numPagina = $this->input->get('pagina');
        }

        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('user_nm'=>$busca, 'Conferencia_Revisor.core_conf_cd'=>$conf_cd);
        }else{
            $busca=null;
            $array = array('Conferencia_Revisor.core_conf_cd'=>$conf_cd);
        }

        $revisores =$this->EdicaoDAO->consultarRevisores($array, $limite, $numPagina);
        if($revisores !== null){
            foreach ($revisores as $revisor) {
                $revisor->modalidadesEixos = $this->ModalidadeTematicaDAO->consultarModaTemaRevisor($revisor->user_cd, $revisor->core_conf_cd);
            }
        }
        $data['revisores'] = $revisores;
        $totalRegistros = count($this->EdicaoDAO->consultarRevisores($array, $limite, $numPagina));
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, 'usuario/consultar/?busca='.$busca);
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Revisores";
        $this->chamaView("revisores", "organizador", $data, 1);
    }

    public function selecionarEvento($edicao){
        
        foreach ($this->session->userdata('eventos_recentes') as $key => $value) {
            if($value->edic_cd == $edicao){
                $this->session->set_userdata('evento_selecionado',$value);
            }
        }
        redirect('organizador/inicio');
    }

    public function aceiteConviteRevisor($revisor, $conferencia){
        $retorno = $this->EdicaoDAO->aceitarRecusarConvite($revisor, $conferencia, "Convite Aceito");
        if($retorno == 0){
            $this->session->set_flashdata('success','O Convite foi aceito com sucesso! É muito gratificante poder contar com sua colaboração!');
        }else{
            $this->session->set_flashdata('error','Não foi possível aceitar o convite!');
        }
        redirect('revisao/consultar');
    }

    public function recusaConviteRevisor($revisor, $conferencia){
        $retorno = $this->EdicaoDAO->aceitarRecusarConvite($revisor, $conferencia, "Convite Recusado");
        if($retorno == 0){
            $this->session->set_flashdata('success','O Convite foi recusado com sucesso!');
        }else{
            $this->session->set_flashdata('error','Não foi possível recusar o convite!');
        }
         redirect('revisao/consultar');
    }

    public function excluirConvite($revisor, $conferencia){
        $retorno = $this->EdicaoDAO->excluirConvite($revisor, $conferencia);
        if($retorno == 0){
            $this->session->set_flashdata('success','O Revisor foi removido do evento com sucesso!');
        }else{
            $this->session->set_flashdata('error','Não foi possível remover o revisor neste evento!');
        }
         redirect('revisor/consultar');
    }

}
