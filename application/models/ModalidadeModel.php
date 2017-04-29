<?php
    if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

    class ModalidadeModel extends CI_Model{

            public function __construct(){
                    parent::__construct();

                    $this->load->Model( 'dao/ModalidadeDAO' );
            }


            public function valida(){

            }

            public function setaValores(){
            	
            }
    }