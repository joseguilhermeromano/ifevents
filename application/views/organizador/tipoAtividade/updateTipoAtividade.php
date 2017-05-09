<div class="container-fluid">
<h2><span class="glyphicon glyphicon-floppy-save"></span><b> Atualizar Tipo de Atividades</b></h2>
<hr>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    if(!empty($atividade)):
    foreach ($atividade as $data):
        $descricao = $data->tiat_desc;
        //$codigo = $data->conf_cd;
    echo form_open_multipart( 'tipoatividade/alterar/'.$this->uri->segment(3), 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Titulo",
            'class' => 'form-control estilo-input',
             'value' => $data->tiat_nm );
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'descricao', 'placeholder' => 'Descrição', 'id'=>'editor', 'cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input' );
                echo form_textarea( $data, set_value('descricao', $descricao));
        	?>
        </div>
    </div>
</div>


<?php echo '<br><center>'.form_submit("btn_atualizar", "Atualizar",array('class' => 'btn btn-success button',
    "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";

echo form_close();

endforeach;

endif; ?>
</div>
