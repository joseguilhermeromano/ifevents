<h2><span class=""></span><b> Instituição</b></h2>
<hr>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>

<?php echo form_open( 'instituicao/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome', 'placeholder' => "Nome", 'class' => 'form-control estilo-input');
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descricao', 'descricao' ); ?></b><br>
        <textarea name="descricao" placeholder="Descrição" id="editor" rows="10">
            
        </textarea>
        </div>
    </div>
</div>



<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
