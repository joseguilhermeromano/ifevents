<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ModalidadeTematicaModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/ModalidadeTematicaDAO' );
            }

            public $mote_cd;
            public $mote_tipo;
            public $mote_conf_cd;


            public function valida(){
            	$this->form_validation->set_rules( 'nome', 'Denominação', 'trim|required|max_length[100]' );
            	$this->form_validation->set_rules( 'descricao', 'Descrição', 'trim|required|max_length[500]' );
            }

            public function setaValores(){
            	$this->mote_nm = $this->input->post('nome');
            	$this->mote_desc = $this->input->post('descricao');
            }
    }

