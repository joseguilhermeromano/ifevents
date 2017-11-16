<div class="container-fluid">
<h2><span class="glyphicon glyphicon-floppy-save"></span><b> Atualizar Atividades</b></h2>
<hr>
<br>
<?php
  $this->load->helper('html');
  echo alert($this->session);
  echo form_open_multipart( 'atividade/alterar/'.$atividade->ativ_cd, 'role="form" class="formsignin"' );
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
        if($item->tiat_cd == $atividade->ativ_tiat_cd){ ?>
          <option value="<?php echo $item->tiat_cd ?>" selected><?php echo $item->tiat_nm; ?></option>
  <?php }else{ ?>
          <option value="<?php echo $item->tiat_cd ?>"><?php echo $item->tiat_nm; ?></option>
  <?php }
        endforeach;
        $descricao     = isset($atividade->ativ_desc) ? $atividade->ativ_desc : '';
        $atividadeData = isset($atividade->ativ_dt)   ? $atividade->ativ_dt   : '';
  ?>
      </select>
    </div>
  </div>
</div>

<?php echo form_hidden('codigo', isset($atividade->ativ_cd) ? $atividade->ativ_cd : '');?>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( '*Título', 'titulo' ); ?></b>
      <?php $data = array( 'name'=> 'titulo', 'class'=> 'form-control estilo-input',
                         'value'=> (isset($atividade->ativ_nm) ? $atividade->ativ_nm : ''));
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
                echo form_textarea( $data, set_value('descricao', $descricao));
      ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( '*Responsavel', 'responsavel' ); ?></b>
      <?php $data = array( 'name'=> 'responsavel', 'class'=> 'form-control estilo-input',
                           'value'=>(isset($atividade->ativ_responsavel) ? $atividade->ativ_responsavel: ''));
                    echo form_input($data);?>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( '*Data', 'data' ); ?></b>
      <?php $data = array( 'name'=> 'data', 'class'=> 'form-control estilo-input' );
                    echo form_input($data, set_value('atividadeData', date("d-m-Y", strtotime($atividadeData ))));?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( '*Hora do Início', 'início' ); ?></b>
      <?php $data = array( 'name'=>'inicio', 'class'=> 'form-control estilo-input',
                           'value'=>(isset($atividade->ativ_hora_ini) ? $atividade->ativ_hora_ini : '') );
               echo form_input($data);?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <b><?php echo form_label( '*Hora do Término', 'termino' ); ?></b>
      <?php $data = array( 'name'=>'termino', 'class'=> 'form-control estilo-input',
                           'value'=>(isset($atividade->ativ_hora_fin)  ? $atividade->ativ_hora_fin  : '') );
               echo form_input($data);?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <strong><?php echo form_label( '*Local', 'local'); ?> </strong>
      <?php $data = array( 'name'=> 'local', 'class'=> 'form-control estilo-input',
                           'value'=> (isset($atividade->ativ_local) ? $atividade->ativ_local : ''));
                    echo form_input($data);?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <strong><?php echo form_label( '*Quantidade de Vagas', 'quantidadeVagas' )?></strong>
      <?php $data = array( 'name'=> 'quantidadeVagas', 'class'=> 'form-control estilo-input',
                           'value'=> (isset($atividade->ativ_vagas_qtd) ? $atividade->ativ_vagas_qtd : ''));
                    echo form_input($data);?>
    </div>
  </div>
</div>

<?php echo "<br><center><a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>&nbsp;&nbsp;".form_submit("btn_atualizar", "Atualizar", array('class' => 'btn btn-success button',
           "onclick"=>"nicEditors.findEditor('editor').saveContent();"))."</center>";
      echo form_close();
?>
