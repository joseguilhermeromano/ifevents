<h2><b> Mensagens</b></h2>
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
		$message = $data->cont_msg;?>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Mensagem', 'mensagem' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'message', 'placeholder' => 'Descrição','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input' );
                echo form_textarea( $data, set_value('message', $message));
        	?>
        </div>
    </div>
</div>
<a href="<?php echo base_url('/contato/sendEmail/'.$item->cont_cd); ?>"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a>


<?php endforeach;

endif;?>
