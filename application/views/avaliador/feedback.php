
                        
<h2><span class="glyphicon glyphicon-open-file"></span><b> Feedback de Avaliação</b></h2>
<hr>
<br>

 <div class="error"><?php echo validation_errors(); ?></div>

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

    <?php if ($this->session->flashdata( 'subm_artigo' )) { ?>
           <div class="alert alert-danger"> 
                 <?= $this->session->flashdata( 'subm_artigo' ) ?> 
           </div>
<?php } ?>

<?php echo form_open_multipart( 'DataControl/submitCadastro', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Assunto do feedback', 'aval_assunto' ); ?></b>
        <?php $data = array( 'name' => 'aval_assunto', 'placeholder' => "Assunto do Feedback", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Escolher Arquivo para Resposta:', 'arquivo_feedback' ); ?></b>
        <?php $data = array( 'name' => 'arquivo_feedback','class' => 'form-control estilo-input');
              echo form_upload($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Feedback', 'feedback' ); ?></b><br>
        <?php   $data = array( 'name' => 'feedback', 'placeholder' => 'Feedback','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
