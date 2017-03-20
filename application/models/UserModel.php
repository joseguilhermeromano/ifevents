<?php
	if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );
        
	class UserModel extends CI_Model{

        public function __construct(){
            parent::__construct();

            $this->load->Model( 'dao/UserDAO' );
            $this->load->Model( 'dao/InstituicaoDAO' );
        }

        public $inst_nm ='';
        public $lista_emails = '';
        public $lista_telefones = '';
        public $qtdMaxSubmissoes = '';
        public $emailLogin='';

        public function login(){
            return $this->UserDAO->consultarLogin($this->input->post('email'),
             $this->input->post('senha'));
        }

        public function setaValores(){

            if(null !== $this->input->post('instituicao')
                && ""!== $this->input->post('instituicao')){
                $array = $this->InstituicaoDAO->consultarCodigo($this->input->post('instituicao'));
                $this->inst_nm = $array[0]['inst_nm'];
            }
            $this->lista_emails = $this->input->post('email');
            $this->lista_telefones = $this->input->post('telefone');
            $this->qtdSubmissoes = $this->input->post('qtdSubmissoes');
            $this->user_id= $this->input->post('codigo');
            $this->user_nm = $this->input->post( 'nome' );      
            $this->user_fone = $this->input->post( 'telefone' );
            $this->user_ins_emp = $this->input->post( 'instituicao' );
            $this->user_biografia = $this->input->post('biografia');
            $this->user_rg = $this->input->post('rg');
            $this->user_cpf = $this->input->post('cpf');
            $this->emailLogin = $this->input->post('emailLogin');
            $this->user_pass=$this->input->post('senha');
            $this->user_tipo=$this->input->post('tipo_usuario');
            $this->user_logradouro=$this->input->post('logradouro');
            $this->user_bairro=$this->input->post('bairro');
            $this->user_numero=$this->input->post('numero');
            $this->user_complemento=$this->input->post('complemento');
            $this->user_cep=$this->input->post('cep');
            $this->user_cidade=$this->input->post('cidade');
            $this->user_uf=$this->input->post('uf');
        }

        public function valida(){

            $this->form_validation->set_rules( 'tipo_usuario', 'Tipo de Usuário', 'trim|required|max_length[11]' );
            $this->form_validation->set_rules( 'nome', 'Nome Completo', 'trim|required|max_length[50]' );
            $this->form_validation->set_rules( 'instituicao', 'Instituição/Empresa', 'trim|max_length[100]' );

            $this->form_validation
            ->set_rules( 'emailLogin', 'Email de Login', 'valid_email|trim|required|max_length[100]' );

            $this->form_validation
            ->set_rules( 'confirmaemail', 'Confirma E-mail', 
                'valid_email|trim|required|max_length[100]|matches[emailLogin]' );

            $this->form_validation
            ->set_rules( 'email[1]', 'E-mail alternativo 1', 'valid_email|trim|max_length[100]|differs[email[2]]|differs[emailLogin]' );

            $this->form_validation
            ->set_rules( 'email[2]', 'E-mail alternativo 2', 'valid_email|trim|max_length[100]|differs[emailLogin]' );

            $this->form_validation->set_rules( 'senha', 'Senha', 'trim|required|min_length[7]' );

            $this->form_validation->set_rules( 'confirmasenha', 'Confirma Senha', 
                'trim|required|min_length[7]|matches[senha]' );

            $this->form_validation->set_rules( 'rg', 'RG', 'trim|required|max_length[9]' );
            $this->form_validation->set_rules( 'cpf', 'CPF', 'valid_cpf' );
            $this->form_validation->set_rules( 'logradouro', 'Logradouro', 'trim|max_length[200]' );
            $this->form_validation->set_rules( 'bairro', 'Bairro', 'trim|max_length[100]' );
            $this->form_validation->set_rules( 'numero', 'Número', 'trim|max_length[9]' );
            $this->form_validation->set_rules( 'complemento', 'Complemento', 'trim|max_length[100]' );
            $this->form_validation->set_rules( 'cep', 'CEP', 'valid_cep' );
            $this->form_validation->set_rules( 'cidade', 'Cidade', 'trim|max_length[100]' );
            $this->form_validation->set_rules( 'uf', 'UF', 'trim|max_length[2]' );
            $this->form_validation->set_rules( 'email', 'E-mail alternativo ', 'trim|max_length[15]' );
            $this->form_validation->set_rules( 'telefone[1]', 'Telefone/Celular 1', 
                'valid_phone|differs[telefone[2]]' );
            $this->form_validation->set_rules( 'telefone[2]', 'Telefone/Celular 2', 'valid_phone' );

            if($this->input->post('tipo_usuario') == 1){
                $this->form_validation->set_rules( 'qtdSubmissoes', 'Qtd. Máxima de Submissões', 'trim|required|max_length[2]' );
            }

            return $this->form_validation->run();
        }

        // public function geraFormulario(){
        //     $html='';
        //     $div_row ='<div class="row">';
        //     $div_col_sm_6='<div class="col-sm-6">';
        //     $div_col_sm_6='<div class="col-sm-4">';
        //     $div_form_group='<div class="form-group">';
        //     $fecha_div='</div>';
        //     $h4='<h4><i>';
        //     $fecha_h4='</i></h4>';

        //     $html .= form_open( 'usuario/cadastrar', 'role="form"' );
        //         $html .= $h4."Dados de acesso".$fecha_h4;
        //         $html .= $div_row;
        //             $html .= $div_col_sm_6;
        //                 $html .= $div_form_group;
        //                     $html .= form_label( '*Tipo de Usuário', 'tipo_usuario' );
        //                     $opcoes = array(
        //                         '-1' => 'Selecionar Tipo de Usuário',
        //                         '0' => 'Participante',
        //                         '1' => 'Avaliador',
        //                         '2' => 'Organizador'
        //                         );
        //                     $data = array(
        //                         'id'    => 'tipoUsuario',
        //                         'class' => 'form-control estilo-input',
        //                         );
        //                     $html .=  form_dropdown('tipo_usuario', $opcoes, '-1',$data);
        //                 $html .= $fecha_div;
        //             $html .= $fecha_div;
        //         $html .= $fecha_div;
        //     $html .= form_fieldset_close();
        //     $html .= form_close();
        //     return $html;
        // }


    }	