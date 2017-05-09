<h2><span class="glyphicon glyphicon-envelope"></span><b> Contato</b></h2>
<hr>
<br>

<?php
    if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error') ?>
    </div>
<?php } ?>
<?php
if(!empty(validation_errors())){
    echo '<div class="alert alert-danger">'.validation_errors().'</div>';
}
?>
<?php
 if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
        <?= $this->session->flashdata('success') ?>
    </div>
<?php
 }
 ?>



<?php echo form_open( 'contato/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'E-mail', 'email' ); ?></b>
        <?php $data = array( 'name' => 'email', 'placeholder' => "E-mail", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Assunto', 'assunto' ); ?></b>
        <?php $data = array( 'name' => 'assunto', 'placeholder' => "Assunto", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Mensagem', 'mensagem' ); ?></b><br>
        <?php   $data = array( 'name' => 'mensagem', 'placeholder' => 'Mensagem...','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
