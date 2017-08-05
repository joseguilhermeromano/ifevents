<div class="container-fluid">
<div class="col-md-8">
<?= $tituloh2 ?>
<hr>
<br>
<?php 
    $this->load->helper('html');
    echo alert($this->session);
?>

<?php
    $segmento = $this->uri->segment(2);
    $linkCadastro = 'instituicao/cadastrar/';
    $linkAltera = $this->uri->uri_string();
    echo form_open_multipart( $segmento != 'alterar' ? $linkCadastro : $linkAltera, 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Nome', 'nome' ); ?></b>
        <?php $data = array( 'name' => 'nome'
            , 'placeholder' => "Denominação"
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($instituicao) ? $instituicao->getNome() : '');
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Abreviação', 'abreviacao' ); ?></b><br>
        	<?php  
        		$data = array( 'name' => 'abreviacao'
                            , 'placeholder' => 'Abreviação'
                            ,'class' => 'form-control estilo-input'
                            , 'value' => isset($instituicao) ? $instituicao->getAbreviacao() : '');
                echo form_input( $data ); 
        	?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="form-group">
        <b><?php echo form_label( 'Logo da instituição', 'image_field' ); ?></b>
            <?php $data = array( 'name' => 'image_field', 'id' => 'imagemInstituicao','type' => 'file',  
              'class' =>'file-uploading');
              echo form_upload($data);?>
        <input type="hidden" name="link_imagem_salva" id="link_imagem" 
               value="<?= isset($instituicao) ? $instituicao->getLogo() : ''; ?>">
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
                            , 'value' => isset($instituicao) ? $instituicao->getDescricao() : '');
                echo form_textarea( $data ); 
        	?>
        </div>
    </div>
</div>

<?php echo "<br><center><a href='".base_url("instituicao/consultar/")."' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;"
        .form_submit("btn_atualizar"
                , $segmento != 'alterar' ? 'Cadastrar' : 'Atualizar'
                ,array('class' => 'btn btn-success button'))."</center>";
    echo form_close();
?>
</div>
</div>



