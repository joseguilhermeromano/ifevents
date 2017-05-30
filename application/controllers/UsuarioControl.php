<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
require_once 'PrincipalControl.php';

class UsuarioControl extends PrincipalControl{

		public function __construct(){
			parent::__construct();

			$this->load->Model( 'dao/UsuarioDAO' );
			$this->load->Model( 'dao/ContatoDAO' );
            $this->load->Model( 'dao/EmailDAO' );
            $this->load->Model( 'dao/TelefoneDAO' );
            $this->load->Model( 'dao/LocalidadeDAO' );
            $this->load->Model( 'dao/InstituicaoDAO' );
			$this->load->Model('UsuarioModel','usuario');
            $this->load->Model('dao/EdicaoDAO');
            $this->load->Model('EmailModel','email');
            $this->load->Model('TelefoneModel','telefone');
            $this->load->Model('LocalidadeModel','localidade');
            $this->load->Model('InstituicaoModel','instituicao');
		}

        public function consultar() {
            $limite = 10;
            $numPagina =0;
            if(null !== $this->input->get('pagina')){
                $numPagina = $this->input->get('pagina');
            }

            if( $this->input->get('busca') !== null){
                $busca = $this->input->get('busca');
                $array = array('user_nm'=>$busca);
            }else{
                $busca=null;
                $array=null;
            }

            $data['users']=$this->UsuarioDAO->consultarTudo($array, $limite, $numPagina);
            $data['paginacao'] = $this->geraPaginacao($limite, $this->UsuarioDAO->totalRegistros(), 'usuario/consultar/?busca='.$busca);
            $data['totalRegistros'] = $this->UsuarioDAO->totalRegistros();
            $data['title']="IFEvents - Usuários";
            $this->chamaView("usuarios", "organizador", $data, 1);
        }

		public function consultarTudo(){
			return null;
		}

        public function consultarEmailSelect(){
            $data = $this->UsuarioDAO->consultarTudo(array('Email.email_email' => $this->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }

        //busca usuário por nome
        public function consultarParaSelect2(){
            $data = $this->UsuarioDAO->consultarTudo(array('User.user_nm' => $this->input->post('term')));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }


        public function ativar($user_cd){
            if(!empty($user_cd)){
                 if($this->UsuarioDAO->ativaDesativa($user_cd, 2)==0){
                    $this->session->set_flashdata('success','O Usuário foi ativado com sucesso!');
                 }else{
                    $this->session->set_flashdata('error','Não foi possível ativar o Usuário!');
                 }
            }
             $this->consultar();
        }

        public function desativar($user_cd){
            if(!empty($user_cd)){
                 if($this->UsuarioDAO->ativaDesativa($user_cd, 3)==0){
                    $this->session->set_flashdata('success','O Usuário foi desativado com sucesso!');
                 }else{
                    $this->session->set_flashdata('error','Não foi possível desativar o Usuário!');
                 }
            }
             $this->consultar();
        }

        public function consultarRevisorSelect2(){
            $data = $this->UsuarioDAO->consultarTudo(array('user_nm' => $this->input->post('term'), 'user_tipo' => 2));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }


        public function excluir($codigo) {

        }



}
