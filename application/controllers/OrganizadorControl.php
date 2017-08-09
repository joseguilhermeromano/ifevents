<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

require_once 'UsuarioControl.php';

class OrganizadorControl extends UsuarioControl{

	public function __construct(){
		parent::__construct();
            $this->load->Model( 'dao/OrganizadorDAO' );
            $this->load->Model( 'dao/InstituicaoDAO' );
            $this->load->Model('OrganizadorModel','organizador');
            $this->load->Model('InstituicaoModel','instituicao');
            $this->load->helper('html');
	}

        public function inicio(){
            $this->consultarUltimosTresEventos();
            $this->chamaView("index", "organizador",
                        array("title"=>"IFEvents - Início - Organizador"), 1);
        }

      public function cadastrar(){
        $data['title'] = "IFEvents - Novo Organizador";
        $data['tituloForm'] = '<i class="fa fa-user-plus" aria-hidden="true"></i><b> Novo Organizador</b>';

      	if (empty($this->input->post())){
            return $this->chamaView("form-organizador", "organizador", $data, 1);
        }

        $this->setaValores();
        $data['organizador'] = $this->organizador;
        
        if($this->valida()){

            $this->db->trans_start();
            try{
                $this->OrganizadorDAO->inserir($this->organizador);
            }catch(Exception $e){
                $this->session->set_flashdata('error', $e->getMessage());
            }
            $this->db->trans_complete();

            if($this ->db->trans_status() !== FALSE){
                $this->session->set_flashdata('success', 'O Organizador foi cadastrado com sucesso!');
                unset($data['organizador']);

            }else{
                $this->session->set_flashdata('error', 'Não foi possível cadastrar o organizador!');
            }
        }

        return $this->chamaView("form-organizador", "organizador", $data, 1);

      }

      public function alterar($codigo){
        $data['title'] = "IFEvents - Editar cadastro de organizador";
        $data['tituloForm'] = '<i class="fa fa-pencil" aria-hidden="true"></i><b> Editar Cadastro de Organizador</b>';

      	
            $this->organizador = $this->OrganizadorDAO->consultarCodigo($codigo);
            if($this->organizador === null){
                $this->session->set_flashdata('error', 'Não foi possível identificar'
                      . ' o organizador no qual se deseja atualizar as informações!');
                redirect('usuario/consultar');
            }
            if(!empty($this->input->post())){

                $this->setaValores();

                if($this->valida()){
                    $this->db->trans_start();
                    try{
                        $this->OrganizadorDAO->alterar($this->organizador);
                    }catch(Exception $e){
                        $this->session->set_flashdata('error', $e->getMessage());
                    }
                    $this->db->trans_complete();

                    if($this ->db->trans_status() !== FALSE){
                        $this->session->set_flashdata('success', 'O Cadastro foi atualizado com sucesso!');
                        $this->organizador = $this->OrganizadorDAO->consultarCodigo($codigo);
                    }elseif($this->session->flashdata('error') === null){
                        $this->session->set_flashdata('success', 'Não foi possível atualizar os dados do organizador!');	
                    }
                }

            }

         $data['organizador'] = $this->organizador;
        return $this->chamaView("form-organizador", "organizador", $data, 1);

      }


      public function perfil(){
        $codigo = $this->session->userdata('usuario')->user_cd;
        $this->organizador = $this->OrganizadorDAO->consultarCodigo($codigo);
        if(!empty($this->input->post())){

	        $this->setaValores();

	        if($this->valida()){
	                $this->db->trans_start();
	                try{
	                    $this->OrganizadorDAO->alterar($this->organizador);
	                }catch(Exception $e){
	                    $this->session->set_flashdata('error', $e->getMessage());
	                }
	                $this->db->trans_complete();

	            if($this ->db->trans_status() === TRUE){
	                $this->session->set_flashdata('success', 'Suas informações foram atualizadas com sucesso!');
                        $this->organizador = $this->OrganizadorDAO->consultarCodigo($codigo);
	            }else{
	            	$this->session->set_flashdata('error', 'Não foi possível atualizar as suas informações!');	
	            }
	        }
           
        }
         $data['title'] = "IFEvents - Meu Perfil";
         $data['tituloForm'] = '<i class="glyphicon glyphicon-user" aria-hidden="true"></i><b> Meu Perfil</b>';
         $data['organizador'] = $this->organizador;
        return $this->chamaView("form-organizador", "organizador", $data, 1);
      }


      private function valida(){
        $this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|max_length[100]' );
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
      	    $this->camposRestritos($this->organizador);
            $this->obtemSenha($this->organizador);
            $codigoInst = $this->input->post('instituicao');
            $this->instituicao = $this->InstituicaoDAO->consultarCodigo($codigoInst);
            $this->organizador->setInstituicao($this->instituicao);
            $this->organizador->setTelefone($this->input->post('telefone'));
            $this->organizador->setLogradouro($this->input->post('logradouro'));
            $this->organizador->setBairro($this->input->post('bairro'));
            $this->organizador->setNumero($this->input->post('numero'));
            $this->organizador->setComplemento($this->input->post('complemento'));
            $this->organizador->setcep($this->input->post('cep'));
            $this->organizador->setCidade($this->input->post('cidade'));
            $this->organizador->setUf($this->input->post('uf'));
      }
      
      
    public function selecionarEventoMenu($edicao){
        foreach ($this->session->userdata('eventos_recentes') as $key => $value) {
            if($value->edic_cd === $edicao){
                $this->session->set_userdata('evento_selecionado',$value);
            }
        }
        redirect('organizador/inicio');
    }

      
}