<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
  require_once 'PrincipalControl.php';

class AtividadeControl extends PrincipalControl{

  public function __construct(){
    parent::__construct();
    $this->load->Model( 'dao/AtividadeDAO' );
    $this->load->Model( 'AtividadeModel','atividade' );
    $this->load->Model( 'dao/TipoAtividadeDAO' );
  }

  public function cadastrar(){
    $data['tipoAtividade'] = $this->TipoAtividadeDAO->consultarTudo();
    $data['title'] = "IFEvents - Atividade - Organizador";
    if (empty($this->atividade->input->post())){
      $this->chamaView("novaatividade", "organizador", $data,  1);
      return true;
    }
    
    $this->setaValores();
    $data['atividade'] = $this->atividade;

    if($this->valida()){

        $this->db->trans_start();
        try{
            $this->AtividadeDAO->inserir($this->atividade);
        }catch(Exception $e){
            $this->session->set_flashdata('error', $e->getMessage());
        }
        $this->db->trans_complete();

        if($this ->db->trans_status() === TRUE){
            $this->session->set_flashdata('success', 'Atividade cadastrada com sucesso!');
            redirect('atividade/consultarTudo');
            }else{
                $this->session->set_flashdata('error', 'Atividade não cadastrada!');
        }

    }

    $this->chamaView("novaatividade", "organizador", $data, 1);
  }
  
    public function inscreverEmAtividade($codigoAtividade){
        $codigoUsuario = $this->session->userdata('usuario')->user_cd;
        
        $this->db->trans_start();
        try{
            $this->AtividadeDAO->inscrever($codigoAtividade,$codigoUsuario);
        }catch(Exception $e){
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('atividade/consultarTudo');
        }
        $this->db->trans_complete();
        
        if($this ->db->trans_status() === true){
            $this->session->set_flashdata('success', 'Inscrição realizada com sucesso!');
        }else{
            $this->session->set_flashdata('error', 'Não foi possível efetuar a inscrição!');
        }
        redirect('atividade/consultarTudo');
    }
    
    public function cancelarInscricaoAtividade($codigoAtividade){
        $codigoUsuario = $this->session->userdata('usuario')->user_cd;
        if($this->AtividadeDAO->cancelarInscricao($codigoAtividade,$codigoUsuario)==true){
            $this->session->set_flashdata('success', 'Inscrição cancelada com sucesso!');
        }else{
            $this->session->set_flashdata('error', 'Não foi cancelar a inscricao!');
        }
        redirect('atividade/consultarTudo');
    }

        /**
         * Alterar um valor existente na base de dados
         * @return Não apresenta retorno
         */
  public function alterar($codigo){
    $data['tipoAtividade'] = $this->TipoAtividadeDAO->consultarTudo();
    $data['title']  = "IFEvents - Atualiza Atividade - organizador";
    $data['atividade'] = $this->AtividadeDAO->consultarCodigo($this->uri->segment(3));
    if(!empty($this->input->post())){
        
        $this->setaValores();
        $data['atividade'] = $this->atividade;

        if($this->valida()){

            $this->db->trans_start();
            try{
                $this->AtividadeDAO->alterar($this->atividade);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() === TRUE){
                $this->session->set_flashdata('success', 'O Atividade atualizada com sucesso!');
                redirect('atividade/consultarTudo/');
            }else{
                $this->session->set_flashdata('error', 'Não foi possível atualizar a atividade!');
            }

        }
    }

    $this->chamaView("edita-atividade", "organizador", $data, 1);
  }

  public function excluir($codigo){
    if( $this->AtividadeDAO->excluir($this->uri->segment(3)) == false){
	$this->session->set_flashdata('error', 'Atividade não pode ser excluida!');
    }
    else{
        $this->session->set_flashdata('success', 'A Atividade foi excluída com sucesso!');
        $this->consultarTudo();
    }
  }

  public function consultarTudo(){
        $getLimiteReg = $this->input->get('limitereg');
        $limite = $getLimiteReg !== null ? $getLimiteReg : 10;
        $getPagina = $this->input->get('pagina');
        $numPagina = $getPagina !== null ? $getPagina : 0;
        $busca=null;
        $array = null;
        $evento = null;
        if($this->isOrganizador()==true){
            $evento = $this->session->userdata('evento_selecionado')->edic_cd;
            $array= array('ativ_edic_cd' => $evento);
        }
        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $numEdicao = preg_replace("/\D/","", $busca);
            $evento =  preg_replace("/[^A-Za-z]/", "", $busca);
            $array = array('Conferencia.conf_abrev'=>$evento
                    , 'edic_num'=> $numEdicao
                    ,'ativ_nm'  => $busca);
        }
        $consulta = $this->AtividadeDAO->consultarTudo($array, $limite, $numPagina);
        $totalRegConsulta = count($this->AtividadeDAO->consultarTudo($array));
        $totalRegTabela = $this->AtividadeDAO->totalRegistros($evento);
        $totalRegistros = !empty($busca) ? $totalRegConsulta : $totalRegTabela;
        $hrefPaginacao = 'atividade/consultarTudo/?busca='.$busca.'&limitereg='.$limite;
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, $hrefPaginacao);
        $data['content']= $consulta;
        $data['busca']= $busca;
        $data['limiteReg']= $limite;
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Atividades";
        $this->chamaView("listaatividade", "organizador", $data, 1);     
  }

  public function setaValores(){
    $this->atividade->setTitulo($this->input->post('titulo'));
    $this->atividade->setDescricao($this->input->post('descricao'));
    $this->atividade->setResponsavel($this->input->post('responsavel'));
    $this->atividade->setData($this->input->post('data'));
    $this->atividade->setInicio($this->input->post('inicio'));
    $this->atividade->setTermino($this->input->post('termino'));
    $this->atividade->setLocal($this->input->post('local'));
    $this->atividade->setQuantidadeVagas($this->input->post('quantidadeVagas'));
    $codigoTipoAtiv = $this->input->post('tipoAtividade');
    $tipoAtividade = $this->TipoAtividadeDAO->consultarCodigo($codigoTipoAtiv);
    $this->atividade->setTipoAtividade($tipoAtividade);
    $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
    $edicao = $this->EdicaoDAO->consultarCodigo($codigoEdicao);
    $this->atividade->setEdicao($edicao);
  }

  public function valida(){
    $this->form_validation->set_rules(	'titulo', 'Titulo', 'trim|required|max_length[100]' );
    $this->form_validation->set_rules(	'descricao', 'Descricao', 'trim|required|max_length[500]' );
    $this->form_validation->set_rules(	'responsavel', 'Responsavel', 'trim|required|max_length[500]' );
    $this->form_validation->set_rules(	'data', 'Data', 'trim|required|max_length[10]' );
    $this->form_validation->set_rules(	'inicio', 'Hora do Início', 'trim|required' );
    $this->form_validation->set_rules(	'termino', 'Hora do Término', 'trim|required' );
    $this->form_validation->set_rules(	'local', 'Loca do Evento', 'trim|required|max_length[100]' );
    $this->form_validation->set_rules(	'quantidadeVagas', 'Vagas', 'integer|trim|required|max_length[10]' );
    $this->form_validation->set_rules(	'tipoAtividade', 'Tipo de Atividade', 'integer|trim|required|max_length[11]' );
    return $this->form_validation->run();
  }

}
