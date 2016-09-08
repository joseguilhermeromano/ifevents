
                        
<h2><span class="glyphicon glyphicon-open-file"></span><b> Novo Artigo</b></h2>
<hr>
<br>

<!--<div class="error"><?php //echo validation_errors(); ?></div>-->
<?php //if($this->session->flashdata('success')==TRUE){ ?>                           
<!--<div class="panel panel-heading alert-info" role="alert">-->
    <?php //echo $this->session->flashdata('success');?>
<!--</div>              -->
<?php //}else{ ?>
<!--    <div class="panel panel-heading alert-info" role="alert">-->
    <?php //echo $this->session->flashdata('error');?>
<!--</div>-->
<?php //} ?>

<?php echo form_open_multipart( 'DataControl/submitCadastro', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>
<div class="row">
    <div class="col-md-6">
        <b>Enviar Artigo:</b>
        <?php $data = array( 'name' => 'subm_artigo' );
              echo form_upload($data);?>
    </div>
    <div class="col-md-6">
        <b><?php echo form_label( 'RA:', 'subm_ra' ); ?></b><br>
        <?php   $data = array('name' => 'subm_ra', 'placeholder' => 'Registro Acadêmico');
                echo form_input($data); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <b><?php echo form_label( 'Título:', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Título" );
               echo form_input($data);?>
    </div>
    <div class="col-md-6">
        <b><?php echo form_label( 'Autor:', 'subm_autor' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_autor', 'placeholder' => 'Autor(es)' );
                echo form_input($data); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <b><?php echo form_label( 'Instituição', 'subm_instituicao' ); ?></b>
        <?php $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'Instituicao' );
              echo form_input( $data );?>
    </div>
    <div class="col-md-6">
        <b><?php echo form_label( 'Resumo', 'subm_resumo' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_resumo', 'placeholder' => 'Resumo' );
                    echo form_input( $data ); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <b><?php echo form_label( 'Área', 'subm_area' ).'<br>'; ?></b>
        <?php $opcoes = array(
                            'Ciência, Educação, Inovação'  => 'Ciência, Educação, Inovação',
                            'Práticas Sustentáveis'        => 'Práticas Sustentáveis',
                            'Ciência Alimentando o Brasil' => 'Ciência Alimentando o Brasil',                            
                            );
                    echo form_dropdown( 'subm_area', $opcoes, 'Selecione uma Área' ).'<br>';?>
    </div>
    <div class="col-md-6">
        <b><?php echo form_label( 'Orientador', 'subm_orientador' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_orientador', 'placeholder' => 'Orientador' );
                    echo form_input( $data );  ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <b><?php echo form_label( 'Apoio', 'subm_apoio' ); ?></b>
        <?php $data = array( 'name' => 'subm_apoio', 'placeholder' => 'Apoio Financeiro' );
                    echo form_input( $data );?>
    </div>
</div>
<?php echo '<br><br>'.form_submit("btn_cadastro", "Cadastrar");

      echo form_fieldset_close();

      echo form_close();
?>
