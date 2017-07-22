<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
  require_once 'PrincipalControl.php';
  require_once 'InterfaceControl.php';

class AtividadeControl extends PrincipalControl implements InterfaceControl{

  public function __construct(){
    parent::__construct();
    $this->load->Model( 'dao/AtividadeDAO' );
    $this->load->Model( 'AtividadeModel','atividade' );
    $this->load->Model( 'dao/TipoAtividadeDAO' );
  }

  public function cadastrar(){
    $data['atividade'] = $this->TipoAtividadeDAO->consultarTudo();
    $data['title'] = "IFEvents - Atividade - Organizador";
    if (empty($this->atividade->input->post())){
      $this->chamaView("novaatividade", "organizador", $data,  1);
      return true;
    }
    $this->recebeValores();
    if( $this->valida()==false){
      $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
    }
    else{
      $this->atividade->setaValores();
      if($this->AtividadeDAO->inserir($this->atividade)==true){
        $this->session->set_flashdata('success', 'Atividade cadastrada com sucesso!');
      }else{
        $this->session->set_flashdata('error', 'Atividade não cadastrada!');
      }
    }
    $this->chamaView("novaatividade", "organizador", $data,  1 );
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
      $this->recebeValores();
      $this->atividade->setaValores();
      if( $this->valida()==false){
        $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
      }
      else{
        if($this->AtividadeDAO->alterar($this->atividade)==true){
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
		    $this->session->set_flashdata('error', 'Arquivo não pode ser excluido!');
		}
		else{
		    $this->session->set_flashdata('success', 'Arquivo deletado com sucesso!');
				redirect('atividade/consultarTudo/');
		}
  }

  public function consultarTudo(){
    $data['flag'] = $this->uri->segment(3);
    $data['content'] = $this->AtividadeDAO->consultarTudo();
    $data['title'] = "IFEvents - Atividades - Organizador";
    $this->chamaView("listaatividade", "organizador", $data, 1);
  }

  public function consultar(){

  }

  public function recebeValores(){
    $this->atividade->setCodigo($this->input->post('codigo'));
    $this->atividade->setTitulo($this->input->post('titulo'));
    $this->atividade->setDescricao($this->input->post('descricao'));
    $this->atividade->setResponsavel($this->input->post('responsavel'));
    $this->atividade->setData($this->input->post('data'));
    $this->atividade->setInicio($this->input->post('inicio'));
    $this->atividade->setTermino($this->input->post('termino'));
    $this->atividade->setLocal($this->input->post('local'));
    $this->atividade->setQuantidadeVagas($this->input->post('quantidadeVagas'));
    $this->atividade->setTipoAtividade($this->input->post('tipoAtividade'));
  }

  public function valida(){
    $this->form_validation->set_rules(	'titulo', 'Titulo', 'trim|required|max_length[100]' );
    $this->form_validation->set_rules(	'descricao', 'Descricao', 'trim|required|max_length[500]' );
    $this->form_validation->set_rules(	'responsavel', 'Responsavel', 'trim|required|max_length[100]' );
    $this->form_validation->set_rules(	'data', 'Data', 'trim|required|max_length[10]' );
    $this->form_validation->set_rules(	'inicio', 'Hora do Início', 'trim|required' );
    $this->form_validation->set_rules(	'termino', 'Hora do Término', 'trim|required' );
    $this->form_validation->set_rules(	'local', 'Loca do Evento', 'trim|required|max_length[100]' );
    $this->form_validation->set_rules(	'quantidadeVagas', 'Quantidade de vagas', 'integer|trim|required|max_length[10]' );
    $this->form_validation->set_rules(	'tipoAtividade', 'Tipo de Atividade', 'integer|trim|required|max_length[11]' );
    return $this->form_validation->run();
  }

}
