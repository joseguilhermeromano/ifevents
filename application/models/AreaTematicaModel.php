<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class AreaTematicaModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/AreaTematicaDAO' );
            }


            public function valida(){

            }

            public function setaValores(){
            	
            }
    }