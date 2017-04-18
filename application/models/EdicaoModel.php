<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class EdicaoModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/EdicaoDAO' );
                    $this->load->Model( 'RegraModel', 'regra' );
            }

            public function setaValores(){
            	$this->edic_conf_cd = $this->input->post('conferencia');
            	$this->edic_comi_cd = $this->input->post('comite');
            	$this->edic_nm = $this->input->post('nome');
            	$this->edic_abrev = $this->input->post('abreviacao');
            	$this->edic_link = $this->input->post('linkevento');
            	$this->edic_apresent = $this->input->post('apresentacao');
            	$this->parcerias = $this->input->post('parcerias[]');
            	$this->regra->setaValores();
            	$this->edic_regras = $this->regra;
            }

            public function valida(){
            	$this->form_validation->set_rules( 'conferencia', 'Conferência', 'trim|required|max_length[11]' );
            	$this->form_validation->set_rules( 'comite', 'Comitê', 'trim|required|max_length[11]' );
            	$this->form_validation->set_rules( 'nome', 'Nome', 'alpha|trim|required|max_length[100]' );
            	$this->form_validation->set_rules( 'abreviacao', 'Abreviação', 'alpha|trim|required|max_length[10]' );
            	$this->form_validation->set_rules( 'linkevento', 'Link do Evento', 
            		'valid_url|trim|required|max_length[100]' );
            	$this->form_validation->set_rules( 'imagemevento', 'Imagem do Evento', 'trim|required|max_length[100]' );
            	$this->form_validation->set_rules( 'apresentacao', 'Apresentação', 'trim|required' );
            	$this->form_validation->set_rules( 'parcerias[]', 'Parcerias', 'trim|required' );
            	$this->regra->valida();
            }

    }

