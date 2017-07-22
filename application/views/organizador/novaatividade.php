<div class="container-fluid">
<h2><span class="glyphicon glyphicon-floppy-save"></span><b> Cadastrar Atividades</b></h2>
<hr>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>
<div class="row">
    <br>
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/atividade/consultarTudo/'); ?>' style="float:left"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    </div>
</div>

<br><br>

<?php
    echo form_open_multipart( 'atividade/cadastrar', 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b>
        <?php echo form_label( '*Tipo de Atividade', 'tipo_atividade' ); ?>
        </b><br>
            <select name="tipoAtividade" id="tipoAtividade" class="form-control estilo-input" required>
                            <option value="-1" selected disabled> Selecionar Tipo de Atividade </option>
                <?php  foreach ( $atividade as $item ): ?>
                            <option value="<?php echo $item->tiat_cd ?>"><?php echo $item->tiat_nm; ?></option>
                <?php   endforeach;
                        ?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	<?php $data = array( 'name' => 'descricao', 'id'=>'editor', 'cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input' );
                echo form_textarea( $data );
        	?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Responsável', 'responsavel' ); ?></b>
        <?php $data = array( 'name' => 'responsavel', 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Data', 'data' ); ?></b>
        <?php $data = array( 'name' => 'data', 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Hora do Início', 'início' ); ?></b>
        <?php $data = array( 'name' => 'inicio', 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Hora do Término', 'termino' ); ?></b>
        <?php $data = array( 'name' => 'termino', 'class' => 'form-control estilo-input' );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong><?php echo form_label( '*Local', 'local'); ?> </strong>
            <?php $data = array( 'name'=> 'local', 'class'=> 'form-control estilo-input' );
                          echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <strong><?php echo form_label( '*Quantidade de Vagas', 'quantidadeVagas' )?></strong>
                    <?php $data = array( 'name' => 'quantidadeVagas', 'class' => 'form-control estilo-input' );
                          echo form_input($data);?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();
?>
</div>
