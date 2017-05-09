<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class AtividadeModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/AtividadeDAO' );
            }

            public function valida(){
            	$this->form_validation->set_rules(	'titulo',         'Titulo',              'trim|required|max_length[100]' );
    			$this->form_validation->set_rules(	'descricao',      'Descricao',           'trim|required|max_length[500]' );
                $this->form_validation->set_rules(	'data',           'Data',                'trim|required|max_length[10]' );
                $this->form_validation->set_rules(	'inicio',         'Hora do Início',      'trim|required' );
                $this->form_validation->set_rules(	'termino',        'Hora do Término',     'trim|required' );
                $this->form_validation->set_rules(	'local',          'Loca do Evento',      'trim|required|max_length[100]' );
                $this->form_validation->set_rules(	'vagasQtd',       'Quantidade de vagas', 'integer|trim|required|max_length[10]' );
                $this->form_validation->set_rules(	'tipo_atividade', 'Tipo de Atividade',   'integer|trim|required|max_length[11]' );
    			return $this->form_validation->run();
            }

            public function setaValores(){
                $data = $this->input->post( 'data' );
                $data = date("Y-m-d",strtotime(str_replace('/','-',$data)));
                
            	$this->ativ_nm        = $this->input->post( 'titulo' );
    			$this->ativ_desc      = $this->input->post( 'descricao' );
                $this->ativ_dt        = $data;
                $this->ativ_hora_ini  = $this->input->post( 'inicio' );
                $this->ativ_hora_fin  = $this->input->post( 'termino' );
                $this->ativ_local     = $this->input->post( 'local' );
                $this->ativ_vagas_qtd = $this->input->post( 'vagasQtd' );
                $this->ativ_tiat_cd   = $this->input->post( 'tipo_atividade' );
            }

    }
