<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ContatoControl extends PrincipalControl implements InterfaceControl{

		public function __construct(){
			parent::__construct();
			$this->load->library('email');
			$this->load->Model( 'dao/ContatoDAO' );
			$this->load->Model('ContatoModel','contato');
		}

        public function cadastrar() {
            if (empty($this->contato->input->post())){
                $this->chamaView("contato", "avaliador",
                    array("title"=>"IFEvents - Novo Contato"), 1);
                return 0;
            }
            if( $this->contato->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{

                $this->contato->setaValores();
				if($this->ContatoDAO->inserir($this->contato)==true){
                    $this->session->set_flashdata('success', 'Mensagem cadastrada com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Mensagem não cadastrada!');
                }

            }
            $this->chamaView("contato", "avaliador",
                    array("title"=>"IFEvents - Novo Contato"), 1);
        }

        public function alterar($codigo) {

        }

        public function consultar() {
			$dados['content'] = $this->ContatoDAO->consultarCodigo($this->uri->segment(3));
			$dados['title']  = "IFEvents - Contato - organizador";
			$this->chamaView("email", "organizador", $dados, 1);
        }

		public function consultarTudo() {
			$data['content'] = $this->ContatoDAO->consultarTudo();
			$data['title']  = "IFEvents - Lista Contatos - organizador";

			$this->chamaView("listacontato", "organizador", $data, 1);
        }


        public function excluir($codigo) {
			if( $this->ContatoDAO->excluir($this->uri->segment(3)) == false){
					$this->session->set_flashdata('error', 'Arquivo não pode ser excluido!');
			}
		   else{
					$this->session->set_flashdata('success', 'Arquivo deletado com sucesso!');
					redirect('contato/consultarTudo/');
				}

        }

		public function sendEmail(){
			$data['flag'] = $this->uri->segment(3);
			$data['title'] = "IFEvents - Email - Organizador";
			if (empty($this->contato->input->post())){
                $this->chamaView("notifica-users", "organizador", $data, 1);
                return 0;
            }
			//$data = print_r($this->contato->valida());
            if( $this->contato->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->contato->setaValores();
                if($this->email->send()){
                    $this->session->set_flashdata('success', 'O Contato foi enviado com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível enviar a mensagem de contato!');
                }

            }

			$this->chamaView("notifica-users", "organizador",
                    array("title"=>"IFEvents - Email - Organizador"), $data,1);
		}

		public function enviar(){

		}

		public function responder(){

			$data['content'] = $this->ContatoDAO->consultarCodigo($this->uri->segment(3));
			$data['title'] = "IFEvents - Email - Organizador";
			if (empty($this->contato->input->post())){
                $this->chamaView("email", "organizador", $data, 1);
                return 0;
            }
			//$data = print_r($this->contato->valida());
            if( $this->contato->valida()==false){
                    $this->session->set_flashdata('error', 'Falta preencher alguns campos!');
            }
            else{
                $this->contato->setaValores();
                if($this->envia_email($value,$notificacao->assunto, $notificacao->mensagem) == true){
                    $this->session->set_flashdata('success', 'Resposta enviada com sucesso!');
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível enviar a resposta!');
                }

            }

			$this->chamaView("email", "organizador", $data, 1);

		}


}
