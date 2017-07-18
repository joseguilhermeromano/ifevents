<h2><span class="glyphicon glyphicon-list"></span><b> Atualizar Conferência</b></h2>
<hr>
<div class="error"><?php echo validation_errors(); ?></div>
<br>
<?php
  $this->load->helper('html');
  echo alert($this->session);
?>

<div class="row">
<br>
  <div class="col-sm-12">
    <a class="btn btn-default margin-button" href='<?php echo site_url('/conferencia/consultarTudo/'); ?>' style="float:left"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
  </div>
</div>
<br><br>
<div class="row">
<?php
	$descricao = isset($content->conf_desc) ? $content->conf_desc: '';

  echo form_open_multipart( 'ConferenciaControl/alterar/'.$content->conf_cd, 'role="form" class="formsignin"' );?>

  <?php

         echo form_hidden('codigo', isset($content->conf_cd) ? $content->conf_cd : '' );?>

  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( 'Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo',
                             'placeholder' => "Título",
                             'class' => 'form-control estilo-input',
                             'value' =>(isset($content->conf_nm) ? $content->conf_nm : '' ));
               echo form_input($data);?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( 'Abreviação', 'abreviacao' ); ?></b>
        <?php $data = array( 'name' => 'abreviacao', 'class' => 'form-control estilo-input',
                             'value' =>(isset($content->conf_abrev) ? $content->conf_abrev : '' ));
               echo form_input($data);?>
    </div>
  </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Descrição', 'descricao' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'descricao',
                               'placeholder' => 'Descrição',
                               'id'=>'editor',
                               'cols' => 200,
                               'rows' =>10,
                               'class' => 'form-control estilo-input' );
                echo form_textarea( $data, set_value('descricao', $descricao));
        	?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Atualizar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();
?>
