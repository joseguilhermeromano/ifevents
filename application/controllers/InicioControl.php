<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
	require_once 'PrincipalControl.php';

	class InicioControl extends PrincipalControl{

		/*Método construtor faz o carregamento de vários componentes
		necessários ao funcionamento do sistema*/

		public function __construct(){
			parent::__construct();
			// $this->load->model('dao/DataBaseDAO');
//			$this->DataBaseDAO->create_table_ci_session();
			$this->load->model('dao/InscricaoDAO');
                        $this->load->model('dao/AtividadeDAO');
			$this->load->model('dao/TipoAtividadeDAO');
		}
		//Método chama a view principal do sistema (Home)
		public function index(){
                    $data = array("title"=>"IFEvents - Página Inicial - Seja bem vindo!");
                    $data['tresUltimosEventos']  = $this->EdicaoDAO->consultarTudo(null,3, null, 'edic_cd','desc');
                    $data['todasEdicoes'] = $this->EdicaoDAO->consultarTudo();
                    $data['todasConferencias'] = $this->ConferenciaDAO->consultarTudo();
                    $this->chamaView("index", "inicio",$data, 0);
		}

		public function sobre(){

			$this->chamaView("sobre", "inicio",
            	array("title"=>"IFEvents - Sobre"), 0);
		}

		public function evento(){
                    $data = array("title"=>"IFEvents - Sobre o Evento");
                    $uri = $this->uri->uri_string();
                    $this->session->set_userdata("link_evento_selecionado", $uri);
                    $evento = $this->EdicaoDAO->consultarPorLink($uri);
                    $data['evento'] = $evento;
                    $data['programacoes'] = $this->programacao($data,$evento->getCodigo());
                    $this->chamaView("evento", "inicio",$data, 0);
		}


		private function programacao($data, $codigoEvento){
                    $array = array('ativ_edic_cd' => $codigoEvento);
                    $consulta = $this->AtividadeDAO->consultarTudo($array);
                    return $consulta;
		}

                //Método que chama a view do login
                public function login(){

                    $this->chamaView("login", "inicio",
                        array("title"=>"IFEvents - Login"), 0);
                }


		public function recuperaSenha(){
                    $this->chamaView("recupera_senha", "inicio",
                    array("title"=>"IFEvents - Recuperação de Senha"), 0);
		}

		public function noPermission(){
			$this->chamaView("noPermission", "inicio",
            	array("title"=>"IFEvents - Erro de Permissão"), 0);
		}

}
