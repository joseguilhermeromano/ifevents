<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
    require_once 'PrincipalControl.php';
    require_once 'InterfaceControl.php';

    class InscricaoControl extends PrincipalControl implements InterfaceControl{

        public function __construct(){
            parent::__construct();
            $this->load->Model( 'dao/InscricaoDAO' );
            $this->load->Model( 'dao/AtividadeDAO' );
            $this->load->Model( 'InscricaoModel','inscricao' );
            $this->load->Model( 'AtividadeModel', 'atividade');
        }

        public function cadastrar(){

        }

        public function inscricao(){
            //$data['content'] = $this->AtividadeDAO->consultarTudo();
            $data['title'] = "IFEvents - Lista Programação - participante";
            $usuario = $this->session->userdata('usuario');
            print_r($usuario);
            $this->inscricao->insc_ativ_cd = $this->uri->segment(3);
            $this->inscricao->insc_user_cd = $this->atividade->getCodigo();
            $this->inscricao->insc_status  = $this->uri->segment(4);
            if($this->InscricaoDAO->inserir($this->inscricao)==true){
                $this->session->set_flashdata('success', 'O Inscrição realizada com sucesso!');
                $this->consultarTudo(); //$this->chamaView("listaprogramacao", "participante", $data, 1);
            }else{
                $this->session->set_flashdata('error', 'Não foi possível efetuar a inscricao!');
            }
        }

        public function alterar($codigo){
            $data['tipoAtividade'] = $this->TipoAtividadeDAO->consultarTudo();
            $data['title']  = "IFEvents - Atualiza Atividade - organizador";
            $data['atividade'] = $this->AtividadeDAO->consultarCodigo($this->uri->segment(3));
            if(!empty($this->input->post())){
                $this->atividade->setaValores();
                $this->atividade->ativ_cd = $this->uri->segment(3);
                if( $this->atividade->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
                }
                else{
                    if($this->AtividadeDAO->alterar($this->atividade)==true){
                        $this->session->set_flashdata('success', 'O Atividade atualizada com sucesso!');
                        redirect('inscricao/consultarTudo/');
                    }else{
                        $this->session->set_flashdata('error', 'Não foi possível atualizar a atividade!');
                    }
                }
            }
            $this->chamaView("edita-atividade", "organizador", $data, 1);
        }

        public function excluir($codigo){
            if( $this->InscricaoDAO->excluir($this->uri->segment(3) == false)){
                $this->session->set_flashdata('error', 'Arquivo não pode ser excluido!');
			}
		    else{
			    $this->session->set_flashdata('success', 'Arquivo deletado com sucesso!');
				redirect('inscricao/consultarTudo/');
			}
        }

        public function consultarTudo(){
            $data['content'] = $this->AtividadeDAO->consultarTudo();
            $data['title'] = "IFEvents - Lista Programacao - Participante";
            $this->chamaView("listaprogramacao", "participante", $data, 1);
        }

        public function consultar(){

        }
}
