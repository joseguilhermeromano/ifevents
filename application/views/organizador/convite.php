<h2><span class="glyphicon glyphicon-envelope"></span><b> Convites</b></h2>
<hr>
<div class="error"><?php echo validation_errors(); ?></div>
<br>
<?php if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
        <?= $this->session->flashdata('success') ?>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error') ?>
    </div>
<?php } ?>

<div class="row">
<?php
    echo form_open_multipart( 'OrganizadorControl/sendEmail', 'role="form" class="formsignin"' );?>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Email', 'email' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'email', 'placeholder' => 'Email', 'class' => 'form-control estilo-input');
                echo form_input( $data );
        	?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Mensagem', 'mensagem' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'mensagem', 'placeholder' => 'Mensagem','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                echo form_textarea( $data );
        	?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        	<?php echo form_checkbox('anexo', 'Anexo','FALSE');?>
            <b><?php echo form_label( 'Anexo', 'anexo' ); ?></b><br>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button'))."</center>";

echo form_close();
?>
