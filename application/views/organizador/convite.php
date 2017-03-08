<h2><span class="glyphicon glyphicon-envelope"></span><b> Convites</b></h2>
<hr>
<div class="error"><?php echo validation_errors(); ?></div>
<br>
<?php if ($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
        <?= $this->session->flashdata('success') ?>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('empty')) { ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('empty') ?>
    </div>
<?php } ?>

<div class="row">
<?php
    echo form_open_multipart( 'OrganizadorControl/enviaEmail', 'role="form" class="formsignin"' );?>
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





=================================================================================================================================

<form method="POST" action="<?=base_url('enviar-email')?>">

<div>
    <label>Seu nome</label>
    <input type="text" name="nome" required/>
</div>

<div>
    <label>Seu email</label>
    <input type="email" name="email" required/>
</div>

<div>
    <label>Uma mensagem pra você</label>
    <textarea name="mensagem" rows="6" required></textarea>
</div>

<div>
    <label><input type="checkbox" name="anexo"/><strong>Enviar anexo</strong></label>
</div>

<div>
    <label><input type="checkbox" name="template"/><strong>Usar template</strong></label>
</div>

<div>
    <input type="submit" value="Enviar"/>
</div>

</form>
