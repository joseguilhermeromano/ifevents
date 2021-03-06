<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

require_once 'PrincipalControl.php';
require_once 'UsuarioControl.php';

class RevisorControl extends UsuarioControl{

    public function __construct(){
        parent::__construct();
        $this->load->Model( 'dao/RevisorDAO' );
        $this->load->Model( 'dao/InstituicaoDAO' );
        $this->load->Model( 'dao/EdicaoDAO' );
        $this->load->Model( 'dao/AvaliacaoDAO' );
        $this->load->Model('RevisorModel','revisor');
        $this->load->Model('InstituicaoModel','instituicao');
    }

    public function inicio(){
        $this->consultarUltimosTresEventos();
        $data = array("title"=>"IFEvents - Início - Avaliador");
        $codigoRevisor = $this->session->userdata('usuario')->user_cd; 
        $data['totalRevisoes']=$this->AvaliacaoDAO->totalTrabalhosAtribuidos($codigoRevisor);
        $data['revisoesAndamento']=$this->AvaliacaoDAO->totalRevisoesPendentes($codigoRevisor);
        $data['revisoesFinalizadas'] = $this->AvaliacaoDAO->totalRevisoesFinalizadas($codigoRevisor);
        $this->chamaView("index", "avaliador", $data, 1);
    }
    
    /*MÉTODO EXCLUSIVO DA ÁREA DO ORGANIZADOR */
    public function cadastrar(){
        $view ="form-revisor";
        $diretorioView = "avaliador";
        $data['title'] = "IFEvents - Novo Revisor";
        $data['tituloForm'] = '<i class="fa fa-user-plus" aria-hidden="true"></i><b> Novo Revisor</b>';
        $areaLayout = 1;
        $erro = 'Não foi possível cadastrar o revisor!';
        $sucesso = 'O Cadastro do revisor foi efetuado com sucesso!';

        if (empty($this->input->post())){
            return $this->chamaView($view, $diretorioView, $data, $areaLayout);
        }


        $this->setaValores();
        $data['revisor'] = $this->revisor;
        
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
                unset($data['revisor']);
            }elseif($this->session->flashdata('error') === null){
            	$this->session->set_flashdata('error', $erro);
            }
        }


        return $this->chamaView($view, $diretorioView, $data, $areaLayout);
      }
      
      public function cadastrarExternoRevisor(){
        $view ="cadastro_revisores";
        $diretorioView = "inicio";
        $data['title'] = "IFEvents - Cadastro de Revisores";
        $areaLayout = 0;
        $erro = 'Não foi possível realizar o seu cadastro!';
        $sucesso = 'Seu cadastro foi realizado com sucesso!Por favor, '
        . 'verifique seu e-mail e confirme o cadastro';

        if (empty($this->input->post())){
            return $this->chamaView($view, $diretorioView, $data, $areaLayout);
        }


        $this->setaValores();
        $data['revisor'] = $this->revisor;

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
                unset($data['revisor']);
            }elseif($this->session->flashdata('error') === null){
                $this->session->set_flashdata('error', $erro);
            }
        }


        return $this->chamaView($view, $diretorioView, $data, $areaLayout);
      }

      public function alterar($codigo){
        $data['title'] = "IFEvents - Editar cadastro de revisor";
        $data['tituloForm'] = '<i class="fa fa-pencil" aria-hidden="true"></i><b> Editar Cadastro de Revisor</b>';
        
        
          $this->revisor = $this->RevisorDAO->consultarCodigo($codigo);
          
          if($this->revisor === null){
              $this->session->set_flashdata('error', 'Não foi possível identificar'
                      . ' o revisor no qual se deseja atualizar as informações!');
              redirect('usuario/consultar');
          }
          
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
                   $this->revisor = $this->RevisorDAO->consultarCodigo($codigo);
                }elseif($this->session->flashdata('error') === null){
                  $this->session->set_flashdata('success', 'Não foi possível atualizar os dados do revisor!');
                }
            }

          }

         $data['revisor'] = $this->revisor;
        return $this->chamaView("form-revisor", "avaliador", $data, 1);
      }

      public function perfil(){
        $codigo = $this->session->userdata('usuario')->user_cd;
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
	                $this->session->set_flashdata('success', 'Suas informações foram atualizadas com sucesso!');
	                $this->revisor = $this->RevisorDAO->consultarCodigo($codigo);
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
            $this->camposRestritos($this->revisor);
            $this->obtemSenha($this->revisor);
            $this->revisor->setInstituicao($this->instituicao);
            $this->revisor->setTelefone($this->input->post('telefone'));
            $this->revisor->setBiografia($this->input->post('biografia'));
            $this->revisor->setLogradouro($this->input->post('logradouro'));
            $this->revisor->setBairro($this->input->post('bairro'));
            $this->revisor->setNumero($this->input->post('numero'));
            $this->revisor->setComplemento($this->input->post('complemento'));
            $this->revisor->setcep($this->input->post('cep'));
            $this->revisor->setCidade($this->input->post('cidade'));
            $this->revisor->setUf($this->input->post('uf'));
      }
      
    public function consultarRevisorSelect2(){
        $data = $this->UsuarioDAO->consultarTudo(array('user_nm' => $this->input->post('term'), 'user_tipo' => 2));
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    public function consultarRevisoresConvidados(){
        $getLimiteReg = $this->input->get('limitereg');
        $limite = $getLimiteReg !== null ? $getLimiteReg : 10;
        $getPagina = $this->input->get('pagina');
        $numPagina = $getPagina !== null ? $getPagina : 0;
        $busca=null;
        $codigoEdicao = $this->session->userdata('evento_selecionado')->edic_cd;
        $array = array('Edicao_Revisor.edre_edic_cd'=>$codigoEdicao);
        if( $this->input->get('busca') !== null){
            $busca = $this->input->get('busca');
            $array = array('user_nm'=>$busca
            , 'Edicao_Revisor.edre_edic_cd'=>$codigoEdicao);
        }
        $consulta = $this->RevisorDAO->
            consultarRevisoresConvidados($array, $limite, $numPagina);
        $totalRegConsulta = count($this->RevisorDAO->
            consultarRevisoresConvidados($array));
        $totalRegTabela = $this->RevisorDAO->totalRegRevConvidados();
        $totalRegistros = !empty($busca) ? $totalRegConsulta : $totalRegTabela;
        $hrefPaginacao = 'revisor/consultar-revisores/?busca='.$busca.'&limitereg='.$limite;
        $data['paginacao'] = $this->geraPaginacao($limite, $totalRegistros, $hrefPaginacao);
        $data['revisores']= $consulta;
        $data['busca']= $busca;
        $data['limiteReg']= $limite;
        $data['totalRegistros'] = $totalRegistros;
        $data['title']="IFEvents - Revisores";
        $this->chamaView("revisores", "organizador", $data, 1);
    }
    
    public function convidarRevisor(){
        $edic_cd = $this->session->userdata("evento_selecionado")->edic_cd;
        $rev_cd = $this->input->post('revisor');
        $edicao = $this->EdicaoDAO->consultarCodigo($edic_cd);
        $rev = $this->RevisorDAO->consultarCodigo($rev_cd);
        $convidou = $this->RevisorDAO->convidarRevisor($rev_cd, $edic_cd);

        $data = $this->stringMensagemConvite($rev, $edicao);
        $mensagem = $this->load->view('template-email/template-email',$data, true);
        $enviouConvite = $this->envia_email($rev->getEmail(), 
            'Convite para Revisão', $mensagem);               


        if($convidou == true && $enviouConvite == true){
            $this->session->set_flashdata('success', 'O Convite foi enviado com sucesso!');
        }else{
            $this->session->set_flashdata('error', 'Não foi possível enviar o convite!');
        }

        redirect('revisor/consultar-revisores');
    }
    
    private function stringMensagemConvite($rev, $edicao){
        $tituloMensagem = '<span>';
        $tituloMensagem .= '<img src="http://www.plantcitylock.com/plantcit/images/email.png" width="33">';
        $tituloMensagem .= '</span>Convite';
                
        $corpoMensagem = '<center>Caro(a) Sr(a). <b>'.$rev->getNomeCompleto().'</b>';
        $corpoMensagem .= ' desejamos saber se você pode nos ajudar na revisão dos trabalhos ';
        $corpoMensagem .= 'para o evento científico <b>'.$edicao->getNumeroEdicao();
        $corpoMensagem .= 'ª '.$edicao->getConferencia()->getAbreviacao().'</b>, que ocorrerá entre o período dos dias <b>';
        $corpoMensagem .= desconverteDataMysql($edicao->getDataInicioAvaliacao()).'</b> até <b>';
        $corpoMensagem .= desconverteDataMysql($edicao->getDataFimAvaliacao());
        $corpoMensagem .='</b>.<br><br>Sua colaboração é muito importante para nós!<br><br></center>';
        $corpoMensagem .= '<center>';
        $corpoMensagem .= '<a href="'.base_url('aceitar-convite/'.$rev->getCodigo().'/'.$edicao->getCodigo());
        $corpoMensagem .= '" target="_blank" class="block-center">';
        $corpoMensagem .= '<b>Aceitar</b></button></a>&nbsp;&nbsp;';
        $corpoMensagem .= '<a href="'.base_url('recusar-convite/'.$rev->getCodigo().'/'.$edicao->getCodigo());
        $corpoMensagem .= '" target="_blank"block-center"><b>Recusar</b></a>';
        $corpoMensagem .= '</center>';
        $corpoMensagem .= '<br><center>'
            . '<b>Obs.:</b> Sua identidade será mantida em absoluto sigilo.'
            . '</center>';

        $data['tituloMensagem'] = $tituloMensagem;
        $data['corpoMensagem'] = $corpoMensagem;
        return $data;
    }
    
    
    public function aceiteConviteRevisor($codigoRevisor, $codigoEdicao){
        $aceite = $this->RevisorDAO->aceitarRecusarConvite
                ($codigoRevisor, $codigoEdicao, "Convite Aceito");
        if($aceite == true){
            $this->session->set_flashdata('success','O Convite foi aceito com sucesso! '
            . 'É muito gratificante poder contar com sua colaboração!');
        }else{
            $this->session->set_flashdata('error','Não foi possível aceitar o convite!');
        }
        redirect('revisao/consultar');
    }

    public function recusaConviteRevisor($codigoRevisor, $codigoEdicao){
        $recusa = $this->RevisorDAO->aceitarRecusarConvite
                ($codigoRevisor, $codigoEdicao, "Convite Recusado");
        if($recusa == true){
            $this->session->set_flashdata('success','O Convite foi recusado com sucesso!');
        }else{
            $this->session->set_flashdata('error','Não foi possível recusar o convite!');
        }
         redirect('revisao/consultar');
    }

    public function excluirConvite($revisor, $conferencia){
        $excluiu = $this->RevisorDAO->excluirConvite($revisor, $conferencia);
        if($excluiu == true){
            $this->session->set_flashdata('success','O Revisor foi removido do evento com sucesso!');
        }else{
            $this->session->set_flashdata('error','Não foi possível remover o revisor neste evento!');
        }
         redirect('revisor/consultar-revisores');
    }

}
