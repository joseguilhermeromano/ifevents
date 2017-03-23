<?php

if ( ! function_exists('alert'))
{
	/**
	 * Alert
	 *
	 * Generates an Alert Bootstrap tag.
	 *
	 * @return	string
	 */
	function alert($session){
		if ($session->flashdata('success')) {
			$alert = '<div class="alert alert-success">'
			.'<h4><b><span class="glyphicon glyphicon-ok"></span> Sucesso</b></h4>'
			.$session->flashdata('success').'</div>'; 
			return $alert;
    	}
		if ($session->flashdata('error')) {
    		$alert = '<div class="alert alert-danger">' 
		    .'<h4><b><span class="glyphicon glyphicon-alert"></span> Erro</b></h4>'
    		.$session->flashdata('error').'</div>';
    		return $alert;
    	}
    	if(!empty(validation_errors())){
		    $alert = '<div class="alert alert-danger">'
		    .'<h4><b><span class="glyphicon glyphicon-alert"></span> Erros de Validação</b></h4>'
		    .validation_errors().'</div>';
		    return $alert;
		}
	}
}