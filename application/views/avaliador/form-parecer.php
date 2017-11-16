
<div class="container-fluid"> 
<div class="col-sm-8">                       
<h2><?= $tituloh2; ?></h2>
<hr>
<br>

<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>

<?php echo form_open_multipart( $this->uri->uri_string(), 'role="form" class="formsignin" enctype="multipart/form-data"' ); ?>

<div class="row">
</div>

<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Resultado', 'resultado' ); ?></b><br>
        <select name="resultado" class="form-control selectComum estilo-input">
          <?php if($avaliacao->getStatus() === null 
                  || $avaliacao->getStatus() == 'Revisão Pendente'){ ?>
            <option value="-1" selected disabled>Selecionar Resultado...</option>
          <?php } ?>
            
          <option value="Revisão Aprovada" 
          <?= $avaliacao->getStatus() == 'Revisão Aprovada' ? 'selected' : '' ?>>Revisão Aprovada</option>
          <option value="Revisão aprovada com ressalvas" 
          <?= $avaliacao->getStatus() == 'Revisão aprovada com ressalvas' ? 'selected' : '' ?>>Revisão aprovada com ressalvas</option>
          <option value="Revisão Reprovada" 
          <?= $avaliacao->getStatus() == 'Revisão Reprovada' ? 'selected' : '' ?>>Revisão Reprovada</option>
        </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <b><?php echo form_label( 'Observações', 'observacoes' ); ?></b><br>
        <?php   $data = array( 'name' => 'observacoes', 'id' => 'editor','placeholder' => 'Observações','cols' => 200, 'rows' =>10,'class' => 'form-control estilo-input');
                    echo form_textarea( $data, set_value('observacoes', 
                    $avaliacao->getParecer()!== null ? $avaliacao->getParecer() : '')); ?>
        <input type="hidden" name="url_anterior" value="<?= isset($urlAnterior) ? $urlAnterior :  $_SERVER['HTTP_REFERER']; ?>">
    </div>
</div>
<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_cadastro", "Enviar",array('class' => 'btn btn-success button'))."</center>";

      echo form_fieldset_close();

      echo form_close();
?>
</div>
</div>
