<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ArtigoModel extends CI_Model{

        public function __construct(){
                parent::__construct();

                $this->load->Model( 'dao/ArtigoDAO' );
                $this->load->Model( 'dao/InstituicaoDAO' );
                $this->load->Model( 'SubmitModel' );
                $this->load->helper('html');
        }

        public $autores;
        public $codigo_autores;
        public $instituicao;
        public $arti_status;
        public $aceite_subm_checked;

        
        public function valida(){

            
            $this->form_validation->set_rules( 'titulo','Título', 'trim|required|max_length[100]' );		
            $this->form_validation->set_rules( 'autor[]', 'Autor(es)', 'trim|required|max_length[200]' );
            $this->form_validation->set_rules( 'modalidade', 'Tipo de Modalidade', 'required' );
            $this->form_validation->set_rules( 'area', 'Eixo Temático', 'required' );		
            $this->form_validation->set_rules( 'orientador', 'Orientador', 'trim|required|max_length[100]' );
            $this->form_validation->set_rules( 'resumo', 'Resumo', 'trim|required|max_length[500]' );
            if(!$this->aceita_subm()){
                $this->form_validation->set_rules( 'aceite', 'Aceite', 'callback_aceita_subm' );
            }
            
            
        }

        public function aceita_subm(){

            if ($this->input->post('aceite'))
            {
                return TRUE;
            }
            else
            {
                $error = 'Por favor, leia e aceite as diretrizes de submissão de trabalhos científicos.';
                $this->form_validation->set_message('aceita_subm', $error);
                return FALSE;
            }

        }
        
        public function setaValores(){
            $this->arti_title = $this->input->post( 'titulo' );
            $this->autores = $this->input->post( 'autor' );
            if(null !== $this->autores){
                 natcasesort($this->autores);
                $i = 0;
                $this->codigo_autores = array();
                foreach ($this->autores as $key => $value) {
                    if(preg_match("/\d+/", htmlentities($value)) > 0){
                        $this->codigo_autores[$i] = somenteNumeros($value);
                        $i++;
                    }
                    $this->autores[$key] =  ajustaNomes($value);
                }

                $this->arti_autores = html_entity_decode(implode(', ', $this->autores));
            }
            $this->arti_orienta = $this->input->post( 'orientador' );
            $this->arti_moda_cd = $this->input->post( 'modalidade' );
            $this->arti_eite_cd = $this->input->post( 'area' );
            $this->arti_resumo = $this->input->post( 'resumo' );
            $this->arti_user_resp_cd = $this->session->userdata('usuario')->user_cd;
            $this->arti_status = 0;
            $this->aceite_subm_checked = $this->input->post('aceite');
        }

       

    }

