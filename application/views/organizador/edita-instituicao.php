<h2><span class=""></span><b> Editar Instituição</b></h2>
<hr>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);

?>

<?php
    $descricao = isset($instituicao->inst_desc) ? $instituicao->inst_desc: '';
    echo form_open( 'instituicao/alterar/'.$instituicao->inst_cd, 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome',
                             'placeholder' => "Nome",
                             'class' => 'form-control estilo-input',
                             'value' =>(isset($instituicao->inst_nm) ? $instituicao->inst_nm : '' ));
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	  <?php
        		$data = array( 'name' => 'descricao',
                           'placeholder' => 'Descrição',
                           'id'=>'editor',
                           'cols' => 200,
                           'rows' =>10,
                           'class' => 'form-control estilo-input' );
                echo form_textarea( $data, set_value('descricao', $descricao));
        	?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
