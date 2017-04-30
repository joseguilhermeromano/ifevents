
<div class="container-fluid">                        
<h2><span class="glyphicon glyphicon-open-file"></span><b> Novo Trabalho</b></h2>
<hr>
<br>

<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>

<?php echo form_open_multipart( 'artigo/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Título", 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
        <b><?php echo form_label( 'Autor', 'autor' ); ?></b><br>
            <select name="autor" class="form-control consultaUsuario" multiple="multiple">
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Orientador', 'orientador' ); ?></b><br>
        <?php   $data = array( 'name' => 'orientador', 'placeholder' => 'Orientador', 'class' => 'form-control estilo-input' );
                    echo form_input( $data );  ?>
        </div>
    </div>
    <div class="col-md-4">
        <b><?php echo form_label( 'Instituição', 'instituicao' ); ?></b><br>
            <select name="instituicao" class="form-control consultaInstituicao" multiple="multiple">
            </select>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Apoio', 'apoio' ); ?></b>
        <?php $data = array( 'name' => 'apoio', 'placeholder' => 'Apoio Financeiro', 'class' => 'form-control estilo-input');
                    echo form_input( $data );?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Tipo de Modalidade', 'modalidade' ); ?></b>
         <select name="modalidade" class="form-control consultaModalidadeTematica">
            <option>Resumo</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <b><?php echo form_label( 'Eixo Temático', 'area' ); ?></b>
         <select name="area" class="form-control consultaModalidadeTematica">
            <option>Eixo temático</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Escolher Artigo PDF:', 'userfile' ); ?></b>
        <?php $data = array( 'name' => 'userfile','id' => 'fileDoc', 'class' => 'form-control estilo-input file-uploading');
              echo form_upload($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Resumo', 'resumo' ); ?></b><br>
        <?php   $data = array( 'name' => 'resumo', 'id' => 'editor', 'placeholder' => 'Resumo','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo "<br><center><a href='".base_url($this->uri->segment(1)."/consultar/")."' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
</div>
