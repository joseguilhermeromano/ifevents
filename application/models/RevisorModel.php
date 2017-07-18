<?php
	if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

	require_once 'UsuarioModel.php';

	class RevisorModel extends UsuarioModel{

		private $biografia;
		
		public static function getTipoUsuario(){
			return 2;
		}

		public function getBiografia(){
			return $this->biografia;
		}

		public function setBiografia($biografia){
			$this->biografia = $biografia;
		}
	}