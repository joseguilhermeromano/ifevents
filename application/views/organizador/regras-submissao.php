<div class="container-fluid">
<div class="col-sm-12 col-md-10">
<h2><span class="fa fa-check-square-o"></span><b> Regras</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>

<?php
    echo form_open_multipart('regras-submissao', 'role="form" class="formsignin"' );
?>

<h4 class="subtitulo"><i>Datas Importantes</i></h4><br>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data de abertura das submissões', 'datainiciosubm' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datainiciosubm', 'placeholder' => "Data de abertura de submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? $regra->getDataInicioSubmissao() : ''));
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data de encerramento das submissões', 'datafimsubm' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datafimsubm', 'placeholder' => "Data de encerramento das submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? $regra->getDataFimSubmissao() : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data de abertura das revisões', 'datainiciorev' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datainiciorev', 'placeholder' => "Data de abertura de submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? $regra->getDataInicioAvaliacao() : ''));
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
        <b><?php echo form_label( '*Data de encerramento das revisões', 'datafimrev' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datafimrev', 'placeholder' => "Data de encerramento das submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? $regra->getDataFimAvaliacao() : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
</div>

<?php echo "<br><center>".form_submit("btn_atualizar", 'Salvar',array('class' => 'btn btn-success button'))."</center><br><br>";

echo form_close();
?>


<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <input type="hidden" id="codigoEdicao" name="codigoEdicao" value="<?=$regra->getCodigo();?>">
        <b><?php echo form_label( 'Upload de Diretrizes de Submissão de Artigos', 'arquivo_submissao' ); ?></b>
            <?php $data = array( 'name' => 'arquivo_submissao'
               , 'id' => 'arquivoSubmissao'
               ,'type' => 'file'
               ,'class' =>'file-uploading');
              echo form_upload($data);?>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
        <b><?php echo form_label( 'Upload de Diretrizes de Revisão', 'arquivo_revisao' ); ?></b>
            <?php $data = array( 'name' => 'arquivo_revisao', 'id' => 'arquivoRevisao','type' => 'file',  
              'class' =>'file-uploading');
              echo form_upload($data);?>
        </div>
    </div>
</div>
</div>
</div>