<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class InstituicaoModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/InstituicaoDAO' );
            }

            public function valida(){
            	$this->form_validation->set_rules(	'nome',      'Nome',      'trim|required|max_length[100]' );
    			$this->form_validation->set_rules(	'descricao', 'Descricao', 'trim|required|max_length[500]' );
    			return $this->form_validation->run();
            }

            public function setaValores(){
            	$this->inst_nm   = $this->input->post( 'nome' );
    			$this->inst_desc = $this->input->post( 'descricao' );                
            }
    }
