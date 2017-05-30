<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ConferenciaModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/ConferenciaDAO' );
            }

            public function valida(){
            	$this->form_validation->set_rules(	'titulo', 'Título', 'trim|required|max_length[100]' );
    			$this->form_validation->set_rules(	'descricao', 'Descrição', 'trim|required|max_length[500]' );
    			return $this->form_validation->run();
            }

            public function setaValores(){
            	$this->conf_nm   = $this->input->post( 'titulo' );
    			$this->conf_desc = $this->input->post( 'descricao' );

            }

    }
