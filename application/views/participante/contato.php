<h2><span class="glyphicon glyphicon-envelope"></span><b> Contato</b></h2>
<hr>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Nome", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'E-mail', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "E-mail", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Assunto', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Assunto", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Mensagem', 'subm_resumo' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_resumo', 'placeholder' => 'Mensagem...','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
