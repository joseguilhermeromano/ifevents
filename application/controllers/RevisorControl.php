<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class RevisorControl extends PrincipalControl{

	public function __construct(){
		parent::__construct();
		$this->load->Model( 'dao/RevisorDAO' );
        $this->load->Model( 'dao/InstituicaoDAO' );
		$this->load->Model('RevisorModel','revisor');
        $this->load->Model('InstituicaoModel','instituicao');
	}

    public function inicio(){
        $this->chamaView("index", "avaliador",
                    array("title"=>"IFEvents - Início - Avaliador"), 1);
    }

    public function cadastrar(){

        $usuarioLogado = $this->session->userdata('usuario');

        $view = "form-revisor";
        $diretorioView = "avaliador";
        $data['title'] = "IFEvents - Cadastro de Revisores";
        $data['tituloForm'] = "Cadastro de Revisores";
        $areaLayout = 0;
        $erro = 'Não foi possível realizar o seu cadastro!';
        $sucesso = 'Seu cadastro foi efetuado com sucesso!';


        if( $usuarioLogado !== null && $usuarioLogado->user_tipo == 3 ){
            $data['title'] = "IFEvents - Novo Revisor";
            $data['tituloForm'] = '<i class="fa fa-user-plus" aria-hidden="true"></i><b> Novo Revisor</b>';
            $areaLayout = 1;
            $erro = 'Não foi possível cadastrar o revisor!';
            $sucesso = 'O Cadastro do revisor foi efetuado com sucesso!';
        }

        if (empty($this->input->post())){
            return $this->chamaView($view, $diretorioView, $data, $areaLayout);
        }


        $this->setaValores();

        if($this->valida()){
                $this->db->trans_start();
                try{
                    $this->RevisorDAO->inserir($this->revisor);
                }catch(Exception $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
                $this->db->trans_complete();

            if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', $sucesso);
                unset($this->revisor);
            }elseif($this->session->flashdata('error') === null){
            	$this->session->set_flashdata('error', $erro);
                $data['revisor'] = $this->revisor;
            }
        }

        
        return $this->chamaView($view, $diretorioView, $data, $areaLayout);
      }

      public function alterar($codigo){
        $data['title'] = "IFEvents - Editar cadastro de revisor";
        $data['tituloForm'] = '<i class="fa fa-pencil" aria-hidden="true"></i><b> Editar Cadastro de Revisor</b>';

        if (isset($codigo)){
          $this->revisor = $this->RevisorDAO->consultarCodigo($codigo);
          if(!empty($this->input->post())){

            $this->setaValores();

            if($this->valida()){
                    $this->db->trans_start();
                    try{
                        $this->RevisorDAO->alterar($this->revisor);
                    }catch(Exception $e){
                        $this->session->set_flashdata('error', $e->getMessage());
                    }
                    $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                   $this->session->set_flashdata('success', 'O Cadastro do revisor foi atualizado com sucesso!');
                    unset($this->organizador);
                }elseif($this->session->flashdata('error') === null){
                  $this->session->set_flashdata('success', 'Não foi possível atualizar os dados do revisor!');  
                }
            }
             
          }

        }else{
          $this->session->set_flashdata('error', 'Não foi possível identificar o revisor no qual se deseja atualizar as informações!');
        }

         $data['revisor'] = $this->revisor;
        return $this->chamaView("form-revisor", "avaliador", $data, 1);
      }

      public function perfil(){
        $this->revisor = $this->RevisorDAO->consultarCodigo($this->session->userdata('usuario')->user_cd);
        if(!empty($this->input->post())){

	        $this->setaValores();

	        if($this->valida()){
	                $this->db->trans_start();
	                try{
	                    $this->RevisorDAO->alterar($this->organizador);
	                }catch(Exception $e){
	                    $this->session->set_flashdata('error', $e->getMessage());
	                }
	                $this->db->trans_complete();

	            if($this ->db->trans_status() !== FALSE){
	                $this->session->set_flashdata('success', 'Suas informações foram atualizadas com sucesso!');
	                unset($this->organizador);
	            }elseif($this->session->flashdata('error') === null){
	            	$this->session->set_flashdata('success', 'Não foi possível atualizar as suas informações!');	
	            }
	        }
           
        }
        $data['title'] = "IFEvents - Atualizar Usuário!";
        $data['tituloForm'] = '<i class="glyphicon glyphicon-user" aria-hidden="true"></i><b> Meu Perfil</b>';
        $data['revisor'] = $this->revisor;
        return $this->chamaView("form-revisor", "avaliador", $data, 1);
      }

      private function valida(){
      	$this->form_validation->set_rules( 'nome', 'Nome Completo', 'trim|required|max_length[50]' );
        $this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|max_length[100]' );
        if($this->input->post('senha') !== null){
        	$this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|min_length[6]' );
        	$this->form_validation->set_rules( 'confirmasenha', 'Confirma Senha',
        	'trim|required|min_length[6]|matches[senha]' );
    	}
        $this->form_validation->set_rules( 'biografia', 'Biografia', 'trim|max_length[200]' );
        $this->form_validation->set_rules( 'rg', 'RG', 'trim|required|max_length[12]' );
        $this->form_validation->set_rules( 'cpf', 'CPF', 'valid_cpf|max_length[14]' );
        $this->form_validation->set_rules( 'logradouro', 'Logradouro', 'required|trim|max_length[200]' );
    	$this->form_validation->set_rules( 'bairro', 'Bairro', 'required|trim|max_length[100]' );
    	$this->form_validation->set_rules( 'cep', 'CEP', 'required|valid_cep' );
    	$this->form_validation->set_rules( 'cidade', 'Cidade', 'required|trim|max_length[100]' );
    	$this->form_validation->set_rules( 'uf', 'UF', 'required|trim|max_length[2]' );
        $this->form_validation->set_rules( 'numero', 'Número', 'trim|required|max_length[9]' );
        $this->form_validation->set_rules( 'complemento', 'Complemento', 'trim|max_length[100]' );
        if($this->input->post('confirmaemail')!==null){
        	$this->form_validation->set_rules( 'email', 'E-mail', 'valid_email|trim|required|max_length[100]' );
        	$this->form_validation->set_rules( 'confirmaemail', 'Confirma E-mail', 
        	'valid_email|trim|required|max_length[100]|matches[email]' );
    	}

        return $this->form_validation->run();

      }

      private function setaValores(){
      	   	$this->revisor->setNomeCompleto(ajustaNomes($this->input->post('nome')));
            $this->revisor->setEmail($this->input->post('email'));
            $this->revisor->setSenha($this->input->post('senha'));
            $this->revisor->setInstituicao($this->instituicao);
            $this->revisor->setRg($this->input->post('rg'));
            $this->revisor->setCpf($this->input->post('cpf'));
            $this->revisor->setTelefone($this->input->post('telefone'));
            $this->revisor->setBiografia($this->input->post('biografia'));
            $this->revisor->setValidaEmail(0);
            $this->revisor->setStatus('Não Validado');
            $this->revisor->setLogradouro($this->input->post('logradouro'));
            $this->revisor->setBairro($this->input->post('bairro'));
            $this->revisor->setNumero($this->input->post('numero'));
            $this->revisor->setComplemento($this->input->post('complemento'));
            $this->revisor->setcep($this->input->post('cep'));
            $this->revisor->setCidade($this->input->post('cidade'));
            $this->revisor->setUf($this->input->post('uf'));
      }
      
}