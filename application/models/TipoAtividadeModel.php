<?php
    if ( !defined( 'BASEPATH')) exit( 'No direct script access allowed');

    class TipoAtividadeModel extends CI_Model{

        public function __construct(){
            parent::__construct();

            $this->load->model('dao/TipoAtividadeDAO');
        }

        public function valida(){
            $this->form_validation->set_rules( 'titulo', 'Titulo', 'trim|required|max_length[100]' );
            $this->form_validation->set_rules( 'descricao', 'Descrição', 'trim|required|max_length[500]');
            return $this->form_validation->run();

        }

        public function setaValores(){
            $this->tiat_nm = $this->input->post('titulo');
            $this->tiat_desc = $this->input->post('descricao');

        }
    }
