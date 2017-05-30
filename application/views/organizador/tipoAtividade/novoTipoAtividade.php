<div class="container-fluid">
<h2><span class="glyphicon glyphicon-floppy-save"></span><b> Cadastrar Tipo de Atividades</b></h2>
<hr>
<br>
<div class="row">
    <br>
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/tipoatividade/consultarTudo/'); ?>' style="float:left"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    </div>
</div>
<br><br>
<?php
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    echo form_open_multipart( 'tipoatividade/cadastrar', 'role="form" class="formsignin"' );

    $activity = (isset($atividade) ? $atividade->tiat_desc : '');
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Titulo",
            'class' => 'form-control estilo-input',
             'value' => (isset($atividade) ? $atividade->tiat_nm : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'descricao', 'id'=>'editor', 'cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                echo form_textarea( $data, set_value('activity', $activity) );
        	?>
        </div>
    </div>
</div>

<?php echo '<br><center>'.form_submit("btn_atualizar", "Enviar", array('class' => 'btn btn-success button' ))."</center>";

echo form_close();
?>
</div>
