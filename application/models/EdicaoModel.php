<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class EdicaoModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/EdicaoDAO' );
                    $this->load->Model( 'dao/ConferenciaDAO' );
                    $this->load->Model( 'dao/ComiteDAO' );
                    $this->load->Model( 'dao/InstituicaoDAO' );
                    $this->load->Model( 'RegraModel');
                    $this->load->Model( 'LocalidadeModel');
                    $this->load->Model( 'EmailModel');
                    $this->load->Model( 'TelefoneModel');
            }

            public $regra;
            public $email;
            public $telefone;
            public $localidade;
            public $conferencia;
            public $comite;

            public function setaValores(){
            	$this->edic_conf_cd = $this->input->post('conferencia');
                $this->conferencia = $this->ConferenciaDAO->consultarTudo(array('conf_cd' => $this->edic_conf_cd), null, null, 'conf_cd')[0];
                $this->edic_comi_cd = $this->input->post('comite');
                $this->comite= $this->ComiteDAO->consultarTudo(array('comi_cd' => $this->edic_comi_cd), null, null, 
                    'comi_cd')[0];
            	$this->edic_nm = $this->input->post('nome');
            	$this->edic_abrev = $this->input->post('abreviacao');
            	$this->edic_link = $this->input->post('linkevento');
            	$this->edic_apresent = $this->input->post('apresentacao');
            	$this->parcerias = $this->input->post('parcerias[]');
                foreach ($this->parcerias as $key => $value) {
                    $listaparcerias[$key] = $this->InstituicaoDAO->consultarCodigo($value)[0];
                }
                $this->parcerias = $listaparcerias;
                $this->RegraModel->setaValoresRegraEdicao();
                $this->regra = $this->RegraModel;
                $this->EmailModel->setaValores(true);
                $this->email = $this->EmailModel;
                $this->TelefoneModel->setaValores();
                $this->telefone = $this->TelefoneModel;
                $this->LocalidadeModel->setaValores();
                $this->localidade = $this->LocalidadeModel;
            }

            public function valida(){

                /*DADOS DA EDIÇÃO*/
            	$this->form_validation->set_rules( 'conferencia', 'Conferência', 'trim|required|max_length[11]' );
            	$this->form_validation->set_rules( 'comite', 'Comitê', 'trim|required|max_length[11]' );
            	$this->form_validation->set_rules( 'nome', 'Nome', 'alpha|trim|required|max_length[100]' );
            	$this->form_validation->set_rules( 'abreviacao', 'Abreviação', 'alpha|trim|required|max_length[10]' );
            	$this->form_validation->set_rules( 'linkevento', 'Link do Evento', 
            		'valid_url|trim|required|max_length[100]' );
            	$this->form_validation->set_rules( 'imagemevento', 'Imagem do Evento', 'trim|required|max_length[100]' );
            	$this->form_validation->set_rules( 'apresentacao', 'Apresentação', 'trim|required' );
            	$this->form_validation->set_rules( 'parcerias[]', 'Parcerias', 'trim|required' );

                /*REGRAS*/
                $this->RegraModel->validaRegraEdicao();

                /*DADOS DE ENDEREÇO DA EDIÇÃO*/
                $this->LocalidadeModel->valida();

                /*DADOS DE CONTATO*/
                $this->TelefoneModel->valida();
                $this->EmailModel->valida();               

            }


            /**
             * Converte de numero arabico para romano
             * @param int $numero numero arabico
             * @return string numero romano em letras maiusculas
             */
            function numero_romano($numero) {
                if ($numero <= 0 || $numero > 3999) {
                    return $numero;
                }

                $n = (int)$numero;
                $y = '';

                // Nivel 1
                while (($n / 1000) >= 1) {
                    $y .= 'M';
                    $n -= 1000;
                }
                if (($n / 900) >= 1) {
                    $y .= 'CM';
                    $n -= 900;
                }
                if (($n / 500) >= 1) {
                    $y .= 'D';
                    $n -= 500;
                }
                if (($n / 400) >= 1) {
                    $y .= 'CD';
                    $n -= 400;
                }

                // Nivel 2
                while (($n / 100) >= 1) {
                    $y .= 'C';
                    $n -= 100;
                }
                if (($n / 90) >= 1) {
                    $y .= 'XC';
                    $n -= 90;
                }
                if (($n / 50) >= 1) {
                    $y .= 'L';
                    $n -= 50;
                }
                if (($n / 40) >= 1) {
                    $y .= 'XL';
                    $n -= 40;
                }

                // Nivel 3
                while (($n / 10) >= 1) {
                    $y .= 'X';
                    $n -= 10;
                }
                if (($n / 9) >= 1) {
                    $y .= 'IX';
                    $n -= 9;
                }
                if (($n / 5) >= 1) {
                    $y .= 'V';
                    $n -= 5;
                }
                if (($n / 4) >= 1) {
                    $y .= 'IV';
                    $n -= 4;
                }

                // Nivel 4
                while ($n >= 1) {
                    $y .= 'I';
                    $n -= 1;
                }

                return $y;
            }

    }

