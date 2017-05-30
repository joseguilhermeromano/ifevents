<?php
	if ( !defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

	require_once 'UsuarioModel.php';

	class OrganizadorModel extends UsuarioModel{

		public static function getTipoUsuario(){
			return 3;
		}

	}