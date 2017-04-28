<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class RegraModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/RegraDAO' );
            }
            public $regr_cd;
            public $regr_subm_abert = null;
            public $regr_subm_encerr = null;
            public $regr_qtd_min_subm_aval = null;
            public $regr_prazo_resp_autor = null;
            public $regr_prazo_resp_aval = null;
            public $regr_dire_subm = null;
            public $regr_dire_aval = null;

            public function validaRegraEdicao(){
                $this->form_validation->set_rules( 'datainicioinsc', 'Data de Início das inscrições', 'trim|required' );
                $this->form_validation->set_rules( 'datafiminsc', 'Data de Término das inscrições', 'trim|required' );
            	$this->form_validation->set_rules( 'datainicioevento', 'Data de Início do Evento', 'trim|required' );
            	$this->form_validation->set_rules( 'datafimevento', 'Data de Término do Evento', 'trim|required' );
            	$this->form_validation->set_rules( 'datainiciopub', 'Data inicial da publicação', 'trim|required' );
            	$this->form_validation->set_rules( 'datafimpub', 'Data final da publicação', 'trim|required' );

            	// $this->form_validation->set_rules( 'datainisub', 'Data da abertura de submissões de trabalhos', 'trim|required' );
            	// $this->form_validation->set_rules( 'datafimsub', 'Data de encerramento das submissões de trabalhos', 'trim|required' );
            	// $this->form_validation->set_rules( 'qtdminsubrev', 'Qtd mínima de submissões por revisor',
            	//  'integer|trim|required' );
            	// $this->form_validation->set_rules( 'prazorev', 'Prazo máximo de resposta do Revisor',
            	//  'integer|trim|required' );
            	// $this->form_validation->set_rules( 'prazopart', 'Prazo máximo de resposta do Participante',
            	//  'integer|trim|required' );
            }

            public function setaValoresRegraEdicao(){
            	$this->regr_insc_ini_dt = converteDataMysql($this->input->post('datainicioinsc'));
            	$this->regr_insc_fin_dt = converteDataMysql($this->input->post('datafiminsc'));
            	$this->regr_even_ini_dt = converteDataMysql($this->input->post('datainicioevento'));
            	$this->regr_even_fin_dt = converteDataMysql($this->input->post('datafimevento'));
            	$this->regr_pub_ini_dt = converteDataMysql($this->input->post('datainiciopub'));
            	$this->regr_pub_fin_dt = converteDataMysql($this->input->post('datafimpub'));
            	// $this->regr_qtd_min_subm_rev = $this->input->post('qtdminsubrev');
            	// $this->regr_prazo_resp_revisor = $this->input->post('prazorev');
            	// $this->regr_prazo_resp_autor = $this->input->post('prazopart');
            }

    }

