<h2><span class="glyphicon glyphicon-list"></span><b> Conferências</b></h2>
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
    echo form_open_multipart( 'OrganizadorControl/cadastraConferencia', 'role="form" class="formsignin"' );?>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Título", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	<?php  
        		$data = array( 'name' => 'descricao', 'placeholder' => 'Descrição','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                echo form_textarea( $data ); 
        	?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Cadastrar",array('class' => 'btn btn-success button'))."</center>";

echo form_close();
?>



