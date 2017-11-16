<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
    require_once 'PrincipalControl.php';
    require_once 'InterfaceControl.php';

    class InscricaoControl extends PrincipalControl{

        public function __construct(){
            parent::__construct();
            $this->load->Model( 'dao/InscricaoDAO' );
            $this->load->Model( 'InscricaoModel','inscricao' );
            $this->load->Model( 'dao/AtividadeDAO' );
            $this->load->Model( 'AtividadeModel','atividade' );
        }

        public function cadastrar(){

        }

        public function inscrever(){
            $this->recebeValores();
            $this->inscricao->setaValores();
            if($this->InscricaoDAO->inserir($this->inscricao)==true){
                $this->session->set_flashdata('success', 'O Inscrição realizada com sucesso!');
                $this->alterar($this->uri->segment(3));
                $this->consultarTudo();
            }else{
                $this->session->set_flashdata('error', 'Não foi possível efetuar a inscricao!');
                $this->consultarTudo();
                }
        }

        public function alterar($codigo){
            $this->atividade = $this->AtividadeDAO->consultarCodigo($codigo);
            $this->atividade->setaValores();
            $this->AtividadeDAO->alterar($this->atividade);
        }

        public function excluir($codigo){
            if( $this->InscricaoDAO->excluir($this->uri->segment(3))== false ){
                $this->session->set_flashdata('error', 'Participação não pode ser cancelado!');
                $this->consultarTudo();
			}
		    else{
			    $this->session->set_flashdata('success', 'Participação Cancelada!');
                $this->alterar($this->uri->segment(3));
                $this->consultarTudo();
			}
        }

        public function consultarTudo(){
            $data['inscrito'] = $this->InscricaoDAO->consultarTudo();
            $data['content']  = $this->AtividadeDAO->consultarTudo();
            $data['title'] = "IFEvents - Lista Programacao - Participante";
            $this->chamaView("listaprogramacao", "participante", $data, 1);
        }

        public function consultar(){
            $data['item'] = $this->AtividadeDAO->consultarCodigo($this->uri->segment(3));
            $this->atividade->setCodigo($data['item']->ativ_cd);
            $this->atividade->setTitulo($data['item']->ativ_nm);
            $this->atividade->setDescricao($data['item']->ativ_desc);
            $this->atividade->setResponsavel($data['item']->ativ_responsavel);
            $this->atividade->setData($data['item']->ativ_dt);
            $this->atividade->setInicio($data['item']->ativ_hora_ini);
            $this->atividade->setTermino($data['item']->ativ_hora_fin);
            $this->atividade->setLocal($data['item']->ativ_local);
            if($data['item']->ativ_vagas_qtd > 0 && $this->uri->segment(4) == 1){
                $this->atividade->setQuantidadeVagas($data['item']->ativ_vagas_qtd -= 1);
            }
            else if($data['item']->ativ_vagas_qtd > 0 && $this->uri->segment(4) == 0){
                $this->atividade->setQuantidadeVagas($data['item']->ativ_vagas_qtd += 1);
            }
            $this->atividade->setTipoAtividade($data['item']->ativ_tiat_cd);
        }

        public function recebeValores(){
            $this->inscricao->setCodigoAtividade($this->uri->segment(3));
            $this->inscricao->setCodigoUsuario($this->session->userdata('usuario')->user_cd);
        }

        public function listarEventos(){
            $data['inscrito'] = $this->InscricaoDAO->consultarTudo();
            $data['content']  = $this->AtividadeDAO->consultarTudo();
            $data['title'] = "IFEvents - Meus Eventos - Participante";
            $this->chamaView("meusEventos", "participante", $data, 1);
        }
}
