<?php
	if( !defined("BASEPATH")) exit( 'No direct script acess allowed' );

	class AcessoControl extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('dao/DataBaseDAO');
			$this->DataBaseDAO->create_table_ci_session();
		}

		public function index(){
			echo "funciona";
		}
	}