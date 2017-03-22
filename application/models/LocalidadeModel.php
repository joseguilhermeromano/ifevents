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
            	$this->loca_uf = $this->input->post('logradouro');
            }

            public function valida(){
            	$this->form_validation->set_rules( 'logradouro', 'Logradouro', 'required|trim|max_length[200]' );
            	$this->form_validation->set_rules( 'bairro', 'Bairro', 'required|trim|max_length[100]' );
            	$this->form_validation->set_rules( 'cep', 'CEP', 'required|valid_cep' );
            	$this->form_validation->set_rules( 'cidade', 'Cidade', 'required|trim|max_length[100]' );
            	$this->form_validation->set_rules( 'uf', 'UF', 'required|trim|max_length[2]' );
            }


    }

