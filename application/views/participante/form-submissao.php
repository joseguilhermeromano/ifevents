<div class="container-fluid">
<div class="col-md-12">
<?= $tituloh2 ?>
<hr>
<br>
<?php 
    $this->load->helper('html');
    echo alert($this->session);

    $segmento = $this->uri->segment(2);
    $linkCadastro = 'submissao/cadastrar/'.$this->uri->segment(3);
    $linkAltera = $this->uri->uri_string();
    echo form_open_multipart( $segmento != 'alterar' ? $linkCadastro : $linkAltera
            , 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Selecionar trabalho sem identificação', 'arqsemident' ); ?></b>
        <?php $data = array( 'name' => 'arqsemident'
            ,'id' => 'arqSemIdent'
            , 'class' => 'form-control estilo-input file-loading');
              echo form_upload($data);?>
        <input type="hidden" name="linkArqSemIdent" id="linkArqSemIdent"
               value="<?= isset($linkArqSemIdent) ? $linkArqSemIdent : ''?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Selecionar trabalho com identificação', 'arqcomident' ); ?></b>
        <?php $data = array( 'name' => 'arqcomident'
            ,'id' => 'arqComIdent'
            , 'class' => 'form-control estilo-input file-loading');
              echo form_upload($data);?>
        <input type="hidden" name="linkArqComIdent" id="linkArqComIdent" 
               value="<?= isset($linkArqComIdent) ? $linkArqComIdent : ''?>">
        </div>
    </div>
</div>

<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;"
        .form_submit("btn_atualizar"
                , $segmento != 'alterar' ? 'Cadastrar' : 'Atualizar'
                ,array('class' => 'btn btn-success button'))."</center>";
    echo form_close();
?>
</div>
</div>

