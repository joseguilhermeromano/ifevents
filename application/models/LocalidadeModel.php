<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class LocalidadeModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/LocalidadeDAO' );
                    
            }

            public function setaValores(){
            	$this->loca_lograd = $this->input->post('logradouro');
            	$this->loca_bairro = $this->input->post('bairro');
            	$this->loca_cep = $this->input->post('cep');
            	$this->loca_cid = $this->input->post('cidade');
            	$this->loca_uf = $this->input->post('uf');
                $this->enus_num=$this->input->post('numero');
                $this->enus_comp=$this->input->post('complemento');
            }

            public function valida(){
            if((null !== $this->input->post('logradouro') &&  !empty($this->input->post('logradouro'))) ||
               (null !== $this->input->post('bairro') &&  !empty($this->input->post('bairro'))) ||
               (null !== $this->input->post('numero') &&  !empty($this->input->post('numero'))) ||
               (null !== $this->input->post('cidade') &&  !empty($this->input->post('cidade'))) ||
               (null !== $this->input->post('cep') &&  !empty($this->input->post('cep'))))
            {
                	$this->form_validation->set_rules( 'logradouro', 'Logradouro', 'required|trim|max_length[200]' );
                	$this->form_validation->set_rules( 'bairro', 'Bairro', 'required|trim|max_length[100]' );
                	$this->form_validation->set_rules( 'cep', 'CEP', 'required|valid_cep' );
                	$this->form_validation->set_rules( 'cidade', 'Cidade', 'required|trim|max_length[100]' );
                	$this->form_validation->set_rules( 'uf', 'UF', 'required|trim|max_length[2]' );
                    $this->form_validation->set_rules( 'numero', 'Número', 'trim|required|max_length[9]' );
                    $this->form_validation->set_rules( 'complemento', 'Complemento', 'trim|max_length[100]' );
                }
            }


    }

