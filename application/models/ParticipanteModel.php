<?php

	if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

	require_once 'UsuarioModel.php';

	class ParticipanteModel extends UsuarioModel{

		public static function getTipoUsuario(){
			return 1;
		}

	}