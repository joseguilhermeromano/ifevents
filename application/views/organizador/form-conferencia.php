<div class="container-fluid">
<div class="col-md-8">
<?= $tituloh2 ?>
<hr>
<br>
<?php 
    $this->load->helper('html');
    echo alert($this->session);
?>

<div class="row">
    <?php
        $segmento = $this->uri->segment(2);
        $linkCadastro = 'conferencia/cadastrar/';
        $linkAltera = $this->uri->uri_string();
        echo form_open_multipart( $segmento != 'alterar' ? $linkCadastro : $linkAltera
                , 'role="form" class="formsignin"' );
    ?>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo'
            , 'placeholder' => "Título"
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($conferencia) ? $conferencia->getTitulo() : '');
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Abreviação', 'abreviacao' ); ?></b>
        <?php $data = array( 'name' => 'abreviacao'
            , 'placeholder' => "Abreviação"
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($conferencia) ? $conferencia->getAbreviacao() : '');
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
                            , 'placeholder' => 'Descrição'
                            ,'cols' => 200
                            , 'rows' =>10
                            ,'class' => 'form-control estilo-input'
                            , 'value' => isset($conferencia) ? $conferencia->getDescricao() : '');
                echo form_textarea( $data ); 
        	?>
        </div>
    </div>
</div>

<?php echo "<br><center><a href='".base_url("conferencia/consultar/")."' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;"
        .form_submit("btn_atualizar"
                , $segmento != 'alterar' ? 'Cadastrar' : 'Atualizar'
                ,array('class' => 'btn btn-success button'))."</center>";
    echo form_close();
?>
</div>
</div>



