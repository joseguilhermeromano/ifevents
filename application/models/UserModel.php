<?php
	if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );
        
	class UserModel extends CI_Model{

        public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/UserDAO' );
        }

        public function login(){
            return $this->UserDAO->consultarLogin($this->input->post('email'),
             $this->input->post('senha'));
        }

        public function setaValores(){
            $this->user_id= $this->input->post('codigo');
            $this->user_nm = $this->input->post( 'nome' );      
            $this->user_fone = $this->input->post( 'telefone' );
            $this->user_ins_emp = $this->input->post( 'instituicao' );
            $this->user_email = $this->input->post( 'email' );
            $this->user_pass=$this->input->post('senha');
            $this->user_tipo=$this->input->post('tipo');
            $this->user_val_email = "12345";
            $this->user_status=1;
            $this->user_logradouro=$this->input->post('logradouro');
            $this->user_bairro=$this->input->post('bairro');
            $this->user_numero=$this->input->post('numero');
            $this->user_complemento=$this->input->post('complemento');
            $this->user_cep=$this->input->post('cep');
            $this->user_cidade=$this->input->post('cidade');
            $this->user_uf=$this->input->post('uf');
        }

        public function valida(){
                $this->form_validation->set_rules( 'nome', 'Nome', 'trim|required|max_length[50]' );
                $this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|required|max_length[100]' );
                $this->form_validation->set_rules( 'telefone', 'Telefone', 'trim|required|max_length[15]' );
                $this->form_validation->set_rules( 'email', 'Email', 'trim|required|max_length[50]' );
                $this->form_validation->set_rules( 'confirmaemail', 'Confirma E-mail', 'trim|required|max_length[50]' );
                $this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|max_length[15]' );
                $this->form_validation->set_rules( 'confirmasenha', 'Confirma Senha', 'trim|required|max_length[15]' );
                $this->form_validation->set_rules( 'logradouro', 'Logradouro', 'trim|max_length[100]' );
                $this->form_validation->set_rules( 'bairro', 'Bairro', 'trim|max_length[15]' );
                $this->form_validation->set_rules( 'numero', 'Número', 'trim|max_length[10]' );
                $this->form_validation->set_rules( 'complemento', 'Complemento', 'trim|max_length[10]' );
                $this->form_validation->set_rules( 'cep', 'CEP', 'trim|max_length[10]' );
                $this->form_validation->set_rules( 'cidade', 'Cidade', 'trim|max_length[10]' );
                $this->form_validation->set_rules( 'uf', 'UF', 'trim|max_length[2]' );
                $this->form_validation->set_rules( 'tipo', 'Tipo de Usuário', 'trim|required|max_length[10]' );
//                $erro=null;
//                if($this->input->post('email')!=$this->input->post('confirmaemail')){
//                    $erro[0]="Os E-mails não se conferem!";
//                    
//                }else if($this->input->post('senha')!=$this->input->post('confirmasenha')){
//                    $erro[1]="As Senhas não se conferem!";
//                    
//                }else if($this->input->post('tipo')<=-1){
//                    $erro[2]="Não foi selecionado um tipo de usuário para o cadastro!";
//                    
//                }
//                if($erro!=null){
//                    $this->session->set_flashdata('errorvalidation',$erro);
//                    return false;
//                }
                return $this->form_validation->run();
        }

    }	