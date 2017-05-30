<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

require_once 'PrincipalControl.php';
require_once 'InterfaceControl.php';

class ParticipanteControl extends PrincipalControl{

    	public function __construct(){
        parent::__construct();
        $this->load->Model( 'dao/ParticipanteDAO' );
        $this->load->Model( 'dao/InstituicaoDAO' );
        $this->load->Model('ParticipanteModel','participante');
        $this->load->Model('InstituicaoModel','instituicao');
    	}

      public function inicio(){
        $this->chamaView("index", "participante",
                array("title"=>"IFEvents - Início - Participante"), 1);
      }

      public function cadastrar(){
        $usuarioLogado = $this->session->userdata('usuario');

        $view = "form-participante";
        $diretorioView = "participante";
        $data['title'] = "IFEvents - Cadastro de Participantes";
        $data['tituloForm'] = "Cadastro de Participantes";
        $areaLayout = 0;
        $sucesso = 'Seu cadastro foi efetuado com sucesso!';
        $erro = 'Não foi possível realizar o seu cadastro!';

        if( $usuarioLogado !== null && $usuarioLogado->user_tipo == 3 ){
            $data['title'] = "IFEvents - Novo Participante";
            $data['tituloForm'] = '<i class="fa fa-user-plus" aria-hidden="true"></i><b> Novo Participante</b>';
            $areaLayout = 1;
            $sucesso = 'O Cadastro do Participante foi efetuado com sucesso!';
            $erro = 'Não foi possível realizar o cadastro do Participante!';
        }

        if (empty($this->input->post())){
                  return $this->chamaView($view, $diretorioView, $data, $areaLayout);
        }

        $this->setaValores();

        if($this->valida()){
                $this->db->trans_start();
                try{
                    $this->ParticipanteDAO->inserir($this->participante);
                }catch(Exception $e){
                    $this->session->set_flashdata('error', $e->getMessage());
                }
                $this->db->trans_complete();

            if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', $sucesso);
                unset($this->participante);
            }elseif($this->session->flashdata('error') === null){
                $this->session->set_flashdata('error', $erro);
                $data['participante'] = $this->participante;
            }
        }

        
        return $this->chamaView($view, $diretorioView, $data, $areaLayout);
      }

      public function alterar($codigo){
        $data['title'] = "IFEvents - Editar cadastro de participante";
        $data['tituloForm'] = '<i class="fa fa-pencil" aria-hidden="true"></i><b> Editar Cadastro de Participante</b>';

        if (isset($codigo)){
          $this->participante = $this->ParticipanteDAO->consultarCodigo($codigo);
          if(!empty($this->input->post())){

            $this->setaValores();

            if($this->valida()){
                    $this->db->trans_start();
                    try{
                        $this->ParticipanteDAO->alterar($this->participante);
                    }catch(Exception $e){
                        $this->session->set_flashdata('error', $e->getMessage());
                    }
                    $this->db->trans_complete();

                if($this ->db->trans_status() !== FALSE){
                    $this->session->set_flashdata('success', 'O Cadastro foi atualizado com sucesso!');
                    unset($this->organizador);
                }elseif($this->session->flashdata('error') === null){
                  $this->session->set_flashdata('success', 'Não foi possível atualizar os dados do participante!');  
                }
            }
             
          }

        }else{
          $this->session->set_flashdata('error', 'Não foi possível identificar o participante no qual se deseja atualizar as informações!');
        }

         $data['participante'] = $this->participante;
        return $this->chamaView("form-participante", "participante", $data, 1);
      }

      public function perfil(){
        $this->participante = $this->ParticipanteDAO->consultarCodigo($this->session->userdata('usuario')->user_cd);
        if(!empty($this->input->post())){

              $this->setaValores();

              if($this->valida()){
                      $this->db->trans_start();
                      try{
                          $this->ParticipanteDAO->alterar($this->organizador);
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
        $data['title'] = "IFEvents - Meu Perfil";
        $data['tituloForm'] = '<i class="glyphicon glyphicon-user" aria-hidden="true"></i><b> Meu Perfil</b>';
        $data['participante'] = $this->participante;
        return $this->chamaView("form-participante", "participante", $data, 1);
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
            $this->participante->setNomeCompleto(ajustaNomes($this->input->post('nome')));
            $this->participante->setEmail($this->input->post('email'));
            $this->participante->setSenha($this->input->post('senha'));
            $this->participante->setInstituicao($this->instituicao);
            $this->participante->setTelefone($this->input->post('telefone'));
            $this->participante->setValidaEmail(0);
            $this->participante->setRg($this->input->post('rg'));
            $this->participante->setCpf($this->input->post('cpf'));
            $this->participante->setStatus('Não Validado');
            $this->participante->setLogradouro($this->input->post('logradouro'));
            $this->participante->setBairro($this->input->post('bairro'));
            $this->participante->setNumero($this->input->post('numero'));
            $this->participante->setComplemento($this->input->post('complemento'));
            $this->participante->setcep($this->input->post('cep'));
            $this->participante->setCidade($this->input->post('cidade'));
            $this->participante->setUf($this->input->post('uf'));
      }
      


}