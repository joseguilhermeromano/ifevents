<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ArtigoModel extends CI_Model{

        public function __construct(){
                parent::__construct();

                $this->load->Model( 'dao/ArtigoDAO' );
                $this->load->Model( 'SubmitModel' );
                $this->load->helper('file');
        }
        
        public function valida(){
            $this->form_validation->set_rules( 'titulo','Título', 'trim|required|max_length[50]|ucwords' );		
            $this->form_validation->set_rules( 'autor', 'Autor(es)', 'trim|required|max_length[50]|ucwords' );
            $this->form_validation->set_rules( 'instituicao', 'Instituição', 'trim|required|max_length[50]|ucwords' );
            $this->form_validation->set_rules( 'modalidade', 'Modalidade da Submissão', 'trim|required|max_length[50]|ucwords' );
            $this->form_validation->set_rules( 'area', 'Eixo Temático', 'trim|required|max_length[50]|ucwords' );		
            $this->form_validation->set_rules( 'orientador', 'Orientedor', 'trim|required|max_length[50]|ucwords' );
            $this->form_validation->set_rules( 'apoio', 'Apoio', 'trim|max_length[50]|ucwords' );
            $this->form_validation->set_rules( 'resumo', 'Resumo', 'trim|required|max_length[100]' );
            return $this->form_validation->run();
        }
        
        public function setaValores(){
            $this->arti_titu = $this->input->post( 'titulo' );
            $this->arti_autor = $this->input->post( 'autor' );
            $this->arti_orie = $this->input->post( 'orientador' );
            $this->arti_inst = $this->input->post( 'instituicao' );
            $this->arti_moda = $this->input->post( 'modalidade' );
            $this->arti_eite = $this->input->post( 'area' );
            $this->arti_apoio = $this->input->post( 'apoio' );	
            $this->arti_resu = $this->input->post( 'resumo' );
        }

       

    }

