<?php

if ( ! function_exists('alert'))
{
	/**
	 * Alert
	 *
	 * Gera um alert com layout bootstrap
	 *
	 * @return	string
	 */
	function alert($session){
		if ($session->flashdata('success')) {
			$alert = '<div class="alert alert-success">'
			.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
			.'<h4><b><span class="glyphicon glyphicon-ok"></span> Sucesso</b></h4>'
			.$session->flashdata('success').'</div>'; 
			$session->set_flashdata('success', '');
			return $alert;
    	}
		if ($session->flashdata('error')) {
    		$alert = '<div class="alert alert-danger">' 
    		.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
		    .'<h4><b><span class="fa fa-times-circle"></span> Erro</b></h4>'
    		.$session->flashdata('error').'</div>';
    		$session->set_flashdata('error', '');
    		return $alert;
    	}
    	if ($session->flashdata('warning')) {
    		$alert = '<div class="alert alert-warning">' 
    		.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
		    .'<h4><b><span class="glyphicon glyphicon-alert"></span> Atenção</b></h4>'
    		.$session->flashdata('warning').'</div>';
    		$session->set_flashdata('warning', '');
    		return $alert;
    	}
    	if ($session->flashdata('info')) {
    		$alert = '<div class="alert alert-info">'
    		.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' 
		    .'<h4><b><span class="glyphicon glyphicon-info-sign"></span> Informação</b></h4>'
    		.$session->flashdata('info').'</div>';
    		$session->set_flashdata('info', '');
    		return $alert;
    	}
    	if($session->flashdata('erros')){
    		$alert = '<div class="alert alert-danger">' 
    		.'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
		    	.'<h4><b><span class="fa fa-times-circle"></span> Erro</b></h4>';
    		foreach($session->flashdata('erros') as $erro){
    			$alert .= $erro.'<br>';
    		}
    		 $alert .= '</div>';
    		return $alert;
    	}
    	if(!empty(validation_errors())){
		    $alert = '<div class="alert alert-danger">'
		    .'<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
		    .'<h4><b><span class="fa fa-times-circle"></span> Erros de Validação</b></h4>'
		    .validation_errors().'</div>';
		    return $alert;
		}
	}

	/**
	 * Conversão de data para padrão Mysql
	 *
	 * Converte a data para o padrão do MySql yyyy-dd-mm
	 *
	 * @return	string
	 */
	function converteDataMysql ($data){
		return $data === null ? null : implode("-",array_reverse(explode("/",$data)));
	}

	/**
	 * Conversão de data para padrão brasileiro
	 *
	 * Converte a data para o padrão do brasileiro dd-mm-yyyy
	 *
	 * @return	string
	 */
	function desconverteDataMysql($data){
		return $data === null ? null : implode("/",array_reverse(explode("-",$data)));
	}


	/**
	* Ajusta nomes deixando as primeiras letras maiúsculas e o resto minúsculo
	* @return string
	**/
	function ajustaNomes($nome){
			setlocale(LC_CTYPE, 'pt_BR');
			$nome = htmlentities($nome);
			$array = array('da', 'das', 'de', 'do', 'dos', 'e');
		    return join(' ',
             array_map(
                 create_function(
                     '$nome',
                     'return (!in_array($nome, ' . var_export($array, true) . ')) ? ucfirst($nome) : $nome;'
                 ),
                 explode(
                     ' ',
                     strtolower($nome)
                 )
             )
         );
	}

	function somenteLetras($string){
		$string = html_entity_decode($string);
		return preg_replace("/[^A-Za-z ,ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÜÚàáâãäåçèéêëìíîïðñòóôõöùüúÿ]/", "", $string);
	}

	function somenteNumeros($string){
		return  preg_replace("/\D/","", $string);
	}

	function geraModal($idModal){

        $modal = '<div id="modalExcluir" class="modal fade">'
            .  '<div class="modal-dialog">'
            .   '<div class="modal-content">'
            .       '<div class="modal-header">'
            .           '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'
            .			'<h4 class="modal-title">Excluir</h4>'
            .       '</div>'
            .       '<div class="modal-body">'
            .            '<p>Deseja realmente excluir este registro?</p>'
            .       '</div>'
            .       '<div class="modal-footer">'
            .       '<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>'
            .		'<button class="btn btn-success" onclick="Executa();">Continuar</button>'
            .       '</div>'
            .    '</div>'
            .  '</div>'
        	.'</div>';
        	
        	return $modal;
	}

}