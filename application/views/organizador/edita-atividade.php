<div class="container-fluid">
<h2><span class="glyphicon glyphicon-floppy-save"></span><b> Atualizar Atividades</b></h2>
<hr>
<br>
<?php
  $this->load->helper('html');
  echo alert($this->session);
  echo form_open_multipart( 'atividade/alterar/'.$atividade->getCodigo(), 'role="form" class="formsignin"' );
?>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label-form-group controls">
        <b>
        <?php echo form_label( '*Tipo de Atividade', 'tipoAtividade' ); ?>
        </b><br>
          <select name="tipoAtividade" id="tipoAtividade" class="form-control estilo-input">
        <?php
          foreach ( $tipoAtividade as $item ):
            
            $codigoTipoAtividade = isset($atividade) ? 
                $atividade->getTipoAtividade()->getCodigo(): 0;
            if($item->tiat_cd == $codigoTipoAtividade){ 
                ?>
              <option value="<?= $codigoTipoAtividade ?>" selected><?= $item->tiat_nm; ?></option>
        <?php }else{ ?>
              <option value="<?= $item->tiat_cd ?>"><?= $item->tiat_nm; ?></option>
        <?php }
            endforeach;
        ?>
          </select>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
        <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
        <?php $data = array( 'name' => 'titulo'
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($atividade) ? $atividade->getTitulo() : '');
               echo form_input($data);?>
        </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( 'Descrição', 'descricao' ); ?></b><br>
      <?php	$data = array( 'name'=>'descricao', 'id'=>'editor', 'cols'=> 200, 'rows'=>10,
                           'class'=> 'form-control estilo-input' );
                $descricao = isset($atividade) ? $atividade->getDescricao() : '';
                echo form_textarea( $data, set_value('descricao', $descricao));
      ?>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
        <b><?php echo form_label( '*Responsável', 'responsavel' ); ?></b>
        <?php $data = array( 'name' => 'responsavel'
            , 'class' => 'form-control estilo-input' 
            , 'value' => isset($atividade) ? $atividade->getResponsavel() : '');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <strong><?php echo form_label( '*Local', 'local'); ?> </strong>
            <?php $data = array( 'name'=> 'local'
                , 'class'=> 'form-control estilo-input'
                , 'value' => isset($atividade) ? $atividade->getLocal() : '');
                          echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <strong><?php echo form_label( '*Vagas', 'quantidadeVagas' )?></strong>
                    <?php $data = array( 'name' => 'quantidadeVagas'
                        , 'class' => 'form-control estilo-input' 
                        , 'value' => isset($atividade) ? $atividade->getQuantidadeVagas() : '');
                          echo form_input($data);?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data', 'data' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
             <?php $data = array( 'name' => 'data'
                 , 'class' => 'form-control estilo-input datepicker'
                 , 'value' => isset($atividade) ? 
                 desconverteDataMysql($atividade->getData()) : '');
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Hora do Início', 'início' ); ?></b>
        <?php $data = array( 'name' => 'inicio'
            , 'class' => 'form-control estilo-input campoHora'
            , 'value' => isset($atividade) ? $atividade->getInicio() : '');
               echo form_input($data);?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        <b><?php echo form_label( '*Hora do Término', 'termino' ); ?></b>
        <?php $data = array( 'name' => 'termino'
            , 'class' => 'form-control estilo-input campoHora'
            , 'value' => isset($atividade) ? $atividade->getTermino() : '');
               echo form_input($data);?>
        </div>
    </div>
</div>

<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_atualizar", "Atualizar", array('class' => 'btn btn-success button',
           "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";
      echo form_close();
?>
