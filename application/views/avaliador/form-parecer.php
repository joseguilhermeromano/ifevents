
<div class="container-fluid"> 
<div class="col-sm-8">                       
<h2><?= $tituloh2; ?></h2>
<hr>
<br>

<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>

<?php echo form_open_multipart( 'revisao/cadastrar', 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
</div>

<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Resultado', 'resultado' ); ?></b><br>
        <select name="resultado" class="form-control selectComum estilo-input">
          <option value="-1" selected disabled>Selecionar Resultado...</option>
          <option value="Revisão Aprovada">Revisão Aprovada</option>
          <option value="Revisão Aprovada com Ressalvas">Revisão Aprovada com Ressalvas</option>
          <option value="Revisão Reprovada">Revisão Reprovada</option>
        </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Observações', 'observacoes' ); ?></b><br>
        <?php   $data = array( 'name' => 'observacoes', 'id' => 'editor','placeholder' => 'Observações','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data ); ?>
    </div>
</div>
<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
</div>
</div>
