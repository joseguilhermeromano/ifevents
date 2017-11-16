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
        $linkCadastro = 'comite/cadastrar/';
        $linkAltera = $this->uri->uri_string();
        echo form_open_multipart( $segmento != 'alterar' ? $linkCadastro : $linkAltera
                , 'role="form" class="formsignin"' );
    ?>
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Denominação', 'denominacao' ); ?></b>
        <?php $data = array( 'name' => 'denominacao'
            , 'placeholder' => "Denominação"
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($comite) ? $comite->getNome() : '');
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
                            , 'value' => isset($comite) ? $comite->getDescricao() : '');
                echo form_textarea( $data ); 
        	?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Equipe', 'equipe' ); ?></b><br>
        	<?php  
        		$data = array( 'name' => 'equipe'
                            , 'placeholder' => 'Equipe'
                            ,'cols' => 200
                            , 'rows' =>10
                            ,'class' => 'form-control estilo-input'
                            ,'id' => 'editor'
                            , 'value' => isset($comite) ? $comite->getEquipe() : '');
                echo form_textarea( $data ); 
        	?>
        </div>
    </div>
</div>

<?php echo "<br><center><a href='".base_url("comite/consultar/")."' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;"
        .form_submit("btn_atualizar"
                , $segmento != 'alterar' ? 'Cadastrar' : 'Atualizar'
                ,array('class' => 'btn btn-success button', 'onclick' => "nicEditors.findEditor('editor').saveContent();"))."</center>";
    echo form_close();
?>
</div>
</div>



