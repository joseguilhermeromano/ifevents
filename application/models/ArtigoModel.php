<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ArtigoModel extends CI_Model{

        public function __construct(){
                parent::__construct();

                $this->load->Model( 'dao/ArtigoDAO' );
                $this->load->Model( 'dao/InstituicaoDAO' );
                // $this->load->Model( 'SubmitModel' );
                $this->load->helper('html');
        }

        public $autores;
        public $codigo_autores;
        public $instituicao;
        public $arti_arq_1;
        public $arti_arq_2;
        public $arti_arq_1_nm;
        public $arti_arq_2_nm;

        
        public function valida(){
            $this->form_validation->set_rules( 'titulo','Título', 'trim|required|max_length[100]' );		
            $this->form_validation->set_rules( 'autor[]', 'Autor(es)', 'trim|required|max_length[200]' );
            $this->form_validation->set_rules( 'instituicao', 'Instituição', 'trim|required' );
            $this->form_validation->set_rules( 'modalidade', 'Tipo de Modalidade', 'required' );
            $this->form_validation->set_rules( 'area', 'Eixo Temático', 'required' );		
            $this->form_validation->set_rules( 'orientador', 'Orientador', 'trim|required|max_length[100]' );
            $this->form_validation->set_rules( 'apoio', 'Apoio', 'trim|max_length[100]' );
            $this->form_validation->set_rules( 'resumo', 'Resumo', 'trim|required|max_length[500]' );
        }
        
        public function setaValores(){
            $this->arti_title = $this->input->post( 'titulo' );
            $this->autores = $this->input->post( 'autor' );
            natcasesort($this->autores);
            if(null !== $this->autores){
                $i = 0;
                $this->codigo_autores = array();
                foreach ($this->autores as $key => $value) {
                    if(preg_match("/\d+/", htmlentities($value)) > 0){
                        $this->codigo_autores[$i] = somenteNumeros($value);
                        $i++;
                    }
                    $this->autores[$key] =  ajustaNomes($value);
                }

                $this->arti_autores = somenteLetras(html_entity_decode(implode(', ', $this->autores)));
            }
            $this->arti_orienta = $this->input->post( 'orientador' );
            if((null != $this->input->post('instituicao')) &&
                !empty($this->input->post('instituicao'))){
                $this->instituicao = $this->InstituicaoDAO->
                    consultarCodigo($this->input->post('instituicao'))[0];
                    $this->arti_inst_cd = $this->instituicao->inst_cd;
            }
            $this->arti_ulti_alte_dt = date("y-m-d");
            $this->arti_ulti_alte_hr = date("H:i");
            $this->arti_moda_cd = $this->input->post( 'modalidade' );
            $this->arti_eite_cd = $this->input->post( 'area' );
            $this->arti_apoio = $this->input->post( 'apoio' );	
            $this->arti_resumo = $this->input->post( 'resumo' );
            $this->arti_user_resp_cd = $this->session->userdata('usuario')[0]['user_cd'];
            $this->arti_status = 0;
        }

       

    }

