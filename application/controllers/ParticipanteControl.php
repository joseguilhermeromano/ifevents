<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

require_once 'UsuarioControl.php';

class ParticipanteControl extends UsuarioControl{

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
        $data['participante'] = $this->participante;
        
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
                unset($data['participante']);
            }elseif($this->session->flashdata('error') === null){
                $this->session->set_flashdata('error', $erro);
            }
        }


        return $this->chamaView($view, $diretorioView, $data, $areaLayout);
      }

      public function alterar($codigo){
        $data['title'] = "IFEvents - Editar cadastro de participante";
        $data['tituloForm'] = '<i class="fa fa-pencil" aria-hidden="true"></i><b> Editar Cadastro de Participante</b>';
        
          $this->participante = $this->ParticipanteDAO->consultarCodigo($codigo);
          if($this->participante === null){
              $this->session->set_flashdata('error', 'Não foi possível identificar'
                      . ' o participante no qual se deseja atualizar as informações!');
              redirect('usuario/consultar');
          }
          
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

                if($this ->db->trans_status() === TRUE){
                    $this->session->set_flashdata('success', 'O Cadastro foi atualizado com sucesso!');
                    $this->participante = $this->ParticipanteDAO->consultarCodigo($codigo);
                }else{
                    $this->session->set_flashdata('error', 'Não foi possível atualizar os dados do participante!');
                }
            }

          }

         $data['participante'] = $this->participante;
        return $this->chamaView("form-participante", "participante", $data, 1);
      }

      public function perfil(){
        $codigo = $this->session->userdata('usuario')->user_cd;
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
                      $this->session->set_flashdata('success', 'Suas informações foram atualizadas com sucesso!');
                      $this->participante = $this->ParticipanteDAO->consultarCodigo($codigo);
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
        $this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|max_length[100]' );
        $this->form_validation->set_rules( 'biografia', 'Biografia', 'trim|max_length[200]' );
        $this->form_validation->set_rules( 'logradouro', 'Logradouro', 'required|trim|max_length[200]' );
        $this->form_validation->set_rules( 'bairro', 'Bairro', 'required|trim|max_length[100]' );
        $this->form_validation->set_rules( 'cep', 'CEP', 'required|valid_cep' );
        $this->form_validation->set_rules( 'cidade', 'Cidade', 'required|trim|max_length[100]' );
        $this->form_validation->set_rules( 'uf', 'UF', 'required|trim|max_length[2]' );
        $this->form_validation->set_rules( 'numero', 'Número', 'trim|required|max_length[9]' );
        $this->form_validation->set_rules( 'complemento', 'Complemento', 'trim|max_length[100]' );
        return $this->form_validation->run();

      }

      private function setaValores(){
            $this->camposRestritos($this->participante);
            $this->obtemSenha($this->participante);
            $codigoInst = $this->input->post('instituicao');
            $this->instituicao = $this->InstituicaoDAO->consultarCodigo($codigoInst);
            $this->participante->setInstituicao($this->instituicao);
            $this->participante->setTelefone($this->input->post('telefone'));
            $this->participante->setLogradouro($this->input->post('logradouro'));
            $this->participante->setBairro($this->input->post('bairro'));
            $this->participante->setNumero($this->input->post('numero'));
            $this->participante->setComplemento($this->input->post('complemento'));
            $this->participante->setCep($this->input->post('cep'));
            $this->participante->setCidade($this->input->post('cidade'));
            $this->participante->setUf($this->input->post('uf'));
      }



}
