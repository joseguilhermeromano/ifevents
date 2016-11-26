<h2><span class="glyphicon glyphicon-list"></span><b> Comitê</b></h2>
<hr>
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

<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger"> 
        <?= $this->session->flashdata('error') ?> 
    </div>
<?php } ?>

<div class="row">
<?php 
    echo form_open_multipart( 'organizador/cadastraComite', 'role="form" class="formsignin"' );?>
    <?php echo form_hidden('comite', 'co');?>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Organizadores', 'organizador' ); ?></b>
        <?php $data = array( 'name' => 'organizador', 'placeholder' => "Organizadores", 'class' => 'form-control estilo-input' );
               echo form_input($data);
        ?>
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



