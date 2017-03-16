
                        
<h2><span class="glyphicon glyphicon-open-file"></span><b> Novo Artigo</b></h2>
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





<?php echo form_open_multipart( 'artigo/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Título", 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Autor', 'autor' ); ?></b><br>
        <?php   $data = array( 'name' => 'autor', 'placeholder' => 'Autor(es)', 'class' => 'form-control estilo-input' );
                echo form_input($data); ?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Orientador', 'orientador' ); ?></b><br>
        <?php   $data = array( 'name' => 'orientador', 'placeholder' => 'Orientador', 'class' => 'form-control estilo-input' );
                    echo form_input( $data );  ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Instituição', 'instituicao' ); ?></b>
        <?php $data = array( 'name' => 'instituicao', 'placeholder' => 'Instituição','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Tipo de Modalidade', 'modalidade' ); ?></b>
        <?php $data = array( 'name' => 'modalidade', 'placeholder' => 'Código da Modalidade','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Eixo Temático', 'area' ); ?></b>
        <?php $data = array( 'name' => 'area', 'placeholder' => 'Código Eixo Temático','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Apoio', 'apoio' ); ?></b>
        <?php $data = array( 'name' => 'apoio', 'placeholder' => 'Apoio Financeiro', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Escolher Artigo PDF:', 'userfile' ); ?></b>
        <?php $data = array( 'name' => 'userfile','class' => 'form-control estilo-input');
              echo form_upload($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Resumo', 'resumo' ); ?></b><br>
        <?php   $data = array( 'name' => 'resumo', 'placeholder' => 'Resumo','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
