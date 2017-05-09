<h2><span class="glyphicon glyphicon-envelope"></span><b> Contato</b></h2>
<hr>
<br>

<div class="error"><?php echo validation_errors(); ?></div>

<?php //if ($this->session->flashdata('success')) { ?>
<!--    <div class="alert alert-success">
        <?php// $this->session->flashdata('success') ?>
    </div>
<?php //} ?>

<?php //if ($this->session->flashdata('empty')) { ?>
    <div class="alert alert-danger">
        <?php// $this->session->flashdata('empty') ?>
    </div>
<?php //} ?>

<?php //if ($this->session->flashdata('fail')) { ?>
    <div class="alert alert-danger">
        <?php //$this->session->flashdata('fail') ?>
    </div>-->
<?php //} ?>



<?php echo form_open( 'ContatoControl/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
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
        <?php   $data = array( 'name' => 'mensagem', 'placeholder' => 'Mensagem...', 'id'=>'editor','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
