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
             md5($this->input->post('senha')));
        }

        public function setaValores($cadastro = true){
            $user = $this->session->userdata('usuario')[0]['user_tipo'];
            $user = empty($user) ? '0' : $user;
            $this->user_nm = $this->input->post( 'nome' );      
            $this->user_instituicao = $this->input->post( 'instituicao' );
            $this->user_biograf = $this->input->post('biografia');
            $this->user_cpf = $this->input->post('cpf');
            if(empty($this->user_cpf)){
                 $this->user_cpf = $this->input->post('cpf');
            }

             if($cadastro == true || 
                ($cadastro == false && $user==3)){
                 $this->user_rg = $this->input->post('rg');
                if(null !== $this->input->post('senha')
                && ""!== $this->input->post('senha')){
                 $this->user_pass=md5($this->input->post('senha'));
                }
             }

             if($user == 3){
                $this->user_tipo = $this->input->post('tipo_usuario');
                $this->user_tipo == 2 ?  $this->user_qtd_subm = $this->input->post('qtdSubmissoes') : '';
             }else if ($this->session->userdata('view') == 'cadastro_revisor'){
                $this->user_tipo = 2;
                $this->user_qtd_subm = $this->input->post('qtdSubmissoes');
             }else{
                $this->user_tipo = 1;
             }

            if($cadastro == true && null !== $this->input->post('senha')
                && ""!== $this->input->post('senha')){
                 $this->user_pass=md5($this->input->post('senha'));
            }

        }

        public function valida($cadastro = true){
            $user = $this->session->userdata('usuario')[0]['user_tipo'];
            $user = empty($user) ? '0' : $user;
            if($user==3){
                $this->form_validation->set_rules( 'tipo_usuario', 'Tipo de Usuário', 'trim|required|max_length[11]' );
            }
            $this->form_validation->set_rules( 'nome', 'Nome Completo', 'trim|required|max_length[50]' );
            $this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|max_length[100]' );

            
            if($cadastro == true){
                $this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|min_length[6]' );
                $this->form_validation->set_rules( 'confirmasenha', 'Confirma Senha', 
                'trim|required|min_length[6]|matches[senha]' );
                $this->form_validation->set_rules( 'rg', 'RG', 'trim|required|max_length[12]' );
            }

            if($cadastro == false && $user==3){
                 $this->form_validation->set_rules( 'rg', 'RG', 'trim|required|max_length[12]' );
                 if(!empty($this->input->post('senha'))&&
                    !empty($this->input->post('confirmasenha'))){
                    $this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|min_length[6]' );
                    $this->form_validation->set_rules( 'confirmasenha', 'Confirma Senha', 
                    'trim|required|min_length[6]|matches[senha]' );
                 }
            }


            if(empty($this->user_cpf)){
                $this->form_validation->set_rules( 'cpf', 'CPF', 'valid_cpf|max_length[14]' );
            }
            


            if($this->session->userdata('view') == 'cadastro_revisor'||
                ($user==3 && !empty($this->user_tipo) && $this->user_tipo == 2)){
                $this->form_validation->set_rules( 'qtdSubmissoes', 'Qtd. Máxima de Submissões', 'trim|required|max_length[2]' );
            }

        }


    }	