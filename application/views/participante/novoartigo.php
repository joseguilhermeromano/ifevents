
                        
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
        <div class="form-group">
        <b><?php echo form_label( 'Título', 'subm_titulo' ); ?></b>
        <?php $data = array( 'name' => 'subm_titulo', 'placeholder' => "Título", 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Autor', 'subm_autor' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_autor', 'placeholder' => 'Autor(es)', 'class' => 'form-control estilo-input' );
                echo form_input($data); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Orientador', 'subm_orientador' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_orientador', 'placeholder' => 'Orientador', 'class' => 'form-control estilo-input' );
                    echo form_input( $data );  ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Instituição', 'subm_instituicao' ); ?></b>
        <?php $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'Instituição','class' => 'form-control estilo-input' );
              echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Eixo Temático', 'subm_area' ).'<br>'; ?></b>
        <?php $opcoes = array(
                            'Ciência, Educação, Inovação'  => 'Ciência, Educação, Inovação',
                            'Práticas Sustentáveis'        => 'Práticas Sustentáveis',
                            'Ciência Alimentando o Brasil' => 'Ciência Alimentando o Brasil',                            
                            );
                    echo form_dropdown( 'subm_area', $opcoes,'',array('class' => 'form-control estilo-input') ).'<br>';?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Tipo de Trabalho', 'subm_area' ).'<br>'; ?></b>
        <?php $opcoes = array(
                            'Pesquisa Científica'  => 'Pesquisa Científica',
                            'Relato de Experiência'  => 'Relato de Experiência',
                            );
                    echo form_dropdown( 'subm_area', $opcoes, 'Selecione uma Área',array('class' => 'form-control estilo-input') ).'<br>';?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Apoio', 'subm_apoio' ); ?></b>
        <?php $data = array( 'name' => 'subm_apoio', 'placeholder' => 'Apoio Financeiro', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Escolher Artigo:', 'subm_artigo' ); ?></b>
        <?php $data = array( 'name' => 'subm_artigo','class' => 'form-control estilo-input');
              echo form_upload($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Resumo', 'subm_resumo' ); ?></b><br>
        <?php   $data = array( 'name' => 'subm_resumo', 'placeholder' => 'Resumo','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo '<br><center>'.form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
