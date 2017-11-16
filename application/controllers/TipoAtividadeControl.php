<?php if ( !defined( 'BASEPATH') ) exit( 'No direct script access allowed');

  require_once 'PrincipalControl.php';

class TipoAtividadeControl extends PrincipalControl{

  public function __construct(){
    parent::__construct();
      $this->load->model('dao/TipoAtividadeDAO');
      $this->load->model('TipoAtividadeModel', 'tipoatividade');
    }

    public function cadastrar() {
        if (empty($this->tipoatividade->input->post())){
          $this->chamaView("novoTipoAtividade", "organizador/tipoAtividade",
          array("title"=>"IFEvents - Tipo de Atividade - Organizador"), 1);
          return 0;
        }
        $this->recebeValores();
        if( $this->valida()==false){
          $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
        }
        else{
          $this->tipoatividade->setaValores();
          if($this->TipoAtividadeDAO->inserir($this->tipoatividade)==true){
            $this->session->set_flashdata('success', 'Atividade cadastrada com sucesso!');
            redirect('tipoatividade/consultarTudo');
          }else{
            $this->session->set_flashdata('error', 'Atividade não cadastrada!');
          }
        }
        $this->chamaView("novoTipoAtividade", "organizador/tipoAtividade",
        array("title"=>"IFEvents - Tipo de Atividade - organizador"), 1);
    }

    public function listaconferencia(){
      $this->chamaView("listaconferencia", "organizador/tipoAtividade",
      array("title"=>"IFEvents - Nova Conferencia - Organizador"), 1);
    }

    public function alterar($codigo) {
      $data['atividade'] = $this->TipoAtividadeDAO->consultarCodigo($this->uri->segment(3));
    	$data['title']  = "IFEvents - Novo Tipo Atividade - organizador";
    	if(!empty($this->input->post())){
        $this->recebeValores();
    	  $this->tipoatividade->setaValores();
    	  if( $this->valida()==false){
    	     $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
    	  }
    	  else{
    	     if($this->TipoAtividadeDAO->alterar($this->tipoatividade)==true){
    	        $this->session->set_flashdata('success', 'Tipo de atividade atualizado com sucesso!');
    	        redirect('tipoatividade/consultarTudo/');
    	     }else{
    	        $this->session->set_flashdata('error', 'Não foi possível atualizar o tipo de atividade!');
    	     }
    	  }
    	}
    	$this->chamaView("updateTipoAtividade", "organizador/tipoAtividade", $data, 1);
    }

    public function consultarTudo() {
        $getLimiteReg = $this->input->get('limitereg');
        $limite = $getLimiteReg !== null ? $getLimiteReg : 10;
        $getPagina = $this->input->get('pagina');
        $numPagina = $getPagina !== null ? $getPagina : 0;
        $busca=null;
        $array= null;
        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('tiat_nm' => $busca);
        }
        $consulta = $this->TipoAtividadeDAO->consultarTudo($array, $limite, $numPagina);
        $totalRegConsulta = count($this->TipoAtividadeDAO->consultarTudo($array));
        $totalRegTabela = $this->TipoAtividadeDAO->totalRegistros();
        $totalRegistros = !empty($busca) ? $totalRegConsulta : $totalRegTabela;
        $hrefPaginacao = 'tipoatividade/consultarTudo/?busca='.$busca.'&limitereg='.$limite;
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, $hrefPaginacao);
        $data['atividade']= $consulta;
        $data['busca']= $busca;
        $data['limiteReg']= $limite;
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Tipos de Atividades";
        $this->chamaView("listatipoatividade", "organizador", $data, 1);
    }
    
    
    public function excluir($codigo) {
      if( $this->TipoAtividadeDAO->excluir($this->uri->segment(3)) == false){
    	   $this->session->set_flashdata('error', 'Tipo de atividade não pode ser excluida!');
      }
    	else{
    	   $this->session->set_flashdata('success', 'Tipo de atividade excluída com sucesso!');
    		 redirect('tipoatividade/consultarTudo/');
    	}
    }

    public function consultarParaSelect2(){
      $data = $this->ConferenciaDAO->consultarTudo(array('conf_nm' => $this->conferencia->input->post('term')));
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function recebeValores(){
      $this->tipoatividade->setCodigo($this->input->post('codigo'));
      $this->tipoatividade->setTitulo($this->input->post('titulo'));
      $this->tipoatividade->setDescricao($this->input->post('descricao'));
    }

    public function valida(){
      $this->form_validation->set_rules( 'titulo', 'Titulo', 'trim|required|max_length[100]' );
      $this->form_validation->set_rules( 'descricao', 'Descrição', 'trim|required|max_length[500]');
      return $this->form_validation->run();
    }
}
