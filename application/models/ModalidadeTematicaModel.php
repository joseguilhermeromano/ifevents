<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ModalidadeTematicaModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/ModalidadeTematicaDAO' );
            }
    }

