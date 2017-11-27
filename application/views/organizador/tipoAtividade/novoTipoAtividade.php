<div class="container-fluid">
<h2><span class="fa fa-plus"></span><b> Cadastrar Tipo de Atividades</b></h2>
<hr>
<br><br>
<?php
        $this->load->helper('html');
        echo alert($this->session);
?>


<?php
    echo form_open_multipart( 'tipoatividade/cadastrar', 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo', 'placeholder' => "Titulo",
            'class' => 'form-control estilo-input',
             'value' => (isset($tipoAtividade) ? $tipoAtividade->getTitulo() : '') );
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
        	<?php
        		$data = array( 'name' => 'descricao'
                            , 'id'=>'editor'
                            , 'cols' => 200
                            , 'rows' =>10
                            ,'class' => 'form-control estilo-input');
                echo form_textarea( $data
                                    , set_value('activity'
                                        ,(isset($tipoAtividade) ? $tipoAtividade->getDescricao() : '')) );
        	?>
        </div>
    </div>
</div>

<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_atualizar", "Enviar", array('class' => 'btn btn-success button' ))."</center>";

echo form_close();
?>
</div>
