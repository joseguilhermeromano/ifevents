<h2><span class=""></span><b> Instituição</b></h2>
<hr>
<br>
<div class="row">
  <div class="col-sm-12">
    <a class="btn btn-default margin-button" href='<?php echo site_url("instituicao/consultarTudo"); ?>' style="float:left"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
  </div>
</div>
<br><br>
<?php
  $this->load->helper('html');
  echo alert($this->session);

  echo form_open( 'instituicao/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Nome da Instituição', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Abreviação', 'abreviacao' ); ?></b>
        <?php $data = array( 'name' => 'abreviacao', 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        <textarea name="descricao" id="editor" rows="10"></textarea>
        </div>
    </div>
</div>



<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
