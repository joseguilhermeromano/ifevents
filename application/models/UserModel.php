<?php
	if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );
        
	class UserModel extends CI_Model{

        public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/UserDAO' );
            $this->load->Model( 'dao/InstituicaoDAO' );
        }

        public function login(){
            return $this->UserDAO->consultarLogin($this->input->post('email'),
             $this->input->post('senha'));
        }

        public function setaValores(){
            if(null !== $this->input->post('senha')
                && ""!== $this->input->post('senha')){
                 $this->user_pass=md5($this->input->post('senha'));
            }
            $this->user_qtd_subm = $this->input->post('qtdSubmissoes');
            $this->user_cd= $this->input->post('codigo');
            $this->user_nm = $this->input->post( 'nome' );      
            $this->user_instituicao = $this->input->post( 'instituicao' );
            $this->user_biograf = $this->input->post('biografia');
            $this->user_rg = $this->input->post('rg');
            $this->user_cpf = $this->input->post('cpf');
            $this->user_tipo=$this->input->post('tipo_usuario');
            $this->user_loca_num=$this->input->post('numero');
            $this->user_loca_comp=$this->input->post('complemento');
        }

        public function valida(){

            $this->form_validation->set_rules( 'tipo_usuario', 'Tipo de Usuário', 'trim|required|max_length[11]' );
            $this->form_validation->set_rules( 'nome', 'Nome Completo', 'trim|required|max_length[50]' );
            $this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|max_length[100]' );

            $this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|min_length[6]' );

            $this->form_validation->set_rules( 'confirmasenha', 'Confirma Senha', 
                'trim|required|min_length[6]|matches[senha]' );

            $this->form_validation->set_rules( 'rg', 'RG', 'trim|required|max_length[12]' );
            $this->form_validation->set_rules( 'cpf', 'CPF', 'valid_cpf|max_length[14]' );


            if($this->input->post('tipo_usuario') == 1){
                $this->form_validation->set_rules( 'qtdSubmissoes', 'Qtd. Máxima de Submissões', 'trim|required|max_length[2]' );
            }

            if((null !== $this->input->post('logradouro') &&  !empty($this->input->post('logradouro'))) ||
               (null !== $this->input->post('bairro') &&  !empty($this->input->post('bairro'))) ||
               (null !== $this->input->post('numero') &&  !empty($this->input->post('numero'))) ||
               (null !== $this->input->post('cidade') &&  !empty($this->input->post('cidade'))) ||
               (null !== $this->input->post('cep') &&  !empty($this->input->post('cep'))))
            {
                $this->form_validation->set_rules( 'numero', 'Número', 'trim|required|max_length[9]' );
                $this->form_validation->set_rules( 'complemento', 'Complemento', 'trim|max_length[100]' );
            }
        }


    }	