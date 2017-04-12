<h2><span class="glyphicon glyphicon-list"></span><b> Atualizar Conferência</b></h2>
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
	if(!empty($content)):
    foreach ($content as $data):
		$descricao = $data->conf_desc;
		//$codigo = $data->conf_cd;
    echo form_open_multipart( 'ConferenciaControl/alterar/'.$this->uri->segment(3), 'role="form" class="formsignin"' );?>

		<?php
			//$data = array( 'name' => 'codigo' );
			//form_hidden($data, set_value('codigo', $codigo));
		?>

    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Título", 'class' => 'form-control estilo-input', 'value' => $data->conf_nm );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'descricao', 'placeholder' => 'Descrição','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input' );
                echo form_textarea( $data, set_value('descricao', $descricao));
        	?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Atualizar",array('class' => 'btn btn-success button'))."</center>";

echo form_close();
endforeach;

endif;?>
