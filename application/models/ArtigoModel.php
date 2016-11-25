<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    include_once 'InterfaceModel.php';

    class ArtigoModel extends CI_Model implements InterfaceModel{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/ArtigoDAO' );
            }

            public function cadastrar() {
                return true;
            }

            public function alterar() {
                return true;
            }

            public function buscar() {
                return null;
            }

            public function buscarTudo() {
                return null;
            }

            public function excluir() {
                return true;
            }

    }

