<div class="container-fluid">
<h2><span class="glyphicon glyphicon-floppy-save"></span><b> Atualizar Tipo de Atividades</b></h2>
<hr>
<br>
<?php
        $this->load->helper('html');
        echo alert($this->session);
        echo form_open_multipart( 'tipoatividade/alterar/'.$this->uri->segment(3), 'role="form" class="formsignin"' );
?>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
      <?php $data = array( 'name' => 'titulo'
                            , 'class' => 'form-control estilo-input'
                            , 'value' =>  isset($tipoAtividade) ? $tipoAtividade->getTitulo() : '');
               echo form_input($data);?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
    	<?php	$data = array( 'name' => 'descricao', 'id'=>'editor', 'cols' => 200, 'rows' =>10,
                           'class' => 'form-control estilo-input' );
                    echo form_textarea( $data, set_value('descricao'
                    , isset($tipoAtividade) ? $tipoAtividade->getDescricao() : ''));
      ?>
    </div>
  </div>
</div>

<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_atualizar", "Atualizar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";
    echo form_close();
?>
</div>
