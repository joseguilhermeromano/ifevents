<?php
	if( !defined("BASEPATH")) exit('No direct script access allowed');
        
        include_once 'InterfaceModel.php';

	class ComiteModel extends CI_Model{

		public function __construct(){
			parent::__construct();

			$this->load->model('dao/ComiteDAO');
		}
                
                public function cadastrar(){
                        $this->form_validation->set_rules('organizador', 'organizadores', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('descricao', 'descrição', 'trim|required|max_length[500]');

			if ($this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('error', 'Por favor preencha todos os campos!');
			}
			else{
                                $this->comi_organizad=$this->input->post( 'organizador' );
				$this->comi_desc=$this->input->post( 'descricao' );
				if($this->ComiteDAO->inserir($this)==true){
                                    $this->session->set_flashdata('success', 'O Comitê foi cadastrado com sucesso!');
                                }else{
                                    $this->session->set_flashdata('error', 'O Comitê não foi cadastrado!');
                                }
			}
                }

		public function verifica(){
			$this->form_validation->set_rules(	'organizador', 'Organizador', 'trim|required|max_length[50]' );
			$this->form_validation->set_rules(	'descricao', 'Descricao', 'trim|required|max_length[500]' );

			if ($this->form_validation->run() == FALSE ){
				$this->session->set_flashdata('empty', 'Por favor preencha todos os campos');
				redirect('OrganizadorControl/comite');
			}
			else{
				$organizador = $this->input->post( 'organizador' );
				$descricao = $this->input->post( 'descricao' );

				$this->ComiteDAO->cadastra($organizador, $descricao );
			}
		}
                

                public function alterar() {
                    return true;
                }

                public function buscar() {
                    return null;
                }

                public function buscarTudo() {
                    return null;
                }

                public function excluir() {
                    return true;
                }

	}