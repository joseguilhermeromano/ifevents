<div class="container-fluid">
<h2><span class="fa fa-check-square-o"></span><b> Regras</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>

<?php
    echo form_open_multipart( $this->uri->segment(2) != 'alterar' ? 'regra-submissao/alterar/' : $this->uri->uri_string(), 'role="form" class="formsignin"' );
?>

<h4 class="subtitulo"><i>Regras de Sumissão</i></h4><br>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de abertura das submissões', 'datainiciosubm' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datainiciosubm', 'placeholder' => "Data de abertura de submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? desconverteDataMysql($regra->regr_subm_abert) : ''));
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de encerramento das submissões', 'datafimsubm' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datafimsubm', 'placeholder' => "Data de encerramento das submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? desconverteDataMysql($regra->regr_subm_encerr) : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
        <b><?php echo form_label( '*Quant. máxima de submissões por autor<br>', 'qtdmaxsubmpart' ); ?></b>
        <?php $data = array( 'name' => 'qtdmaxsubmpart', 'placeholder' => "Quant. máxima de submissões por participante", 
            'class' => 'form-control estilo-input',
             'value' => (isset($regra) ? $regra->regr_qtd_max_subm_part : ''));
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
        <b><?php echo form_label( '*Prazo de resposta (em dias) do autor a uma nova revisão', 'prazoresppart' ); ?></b>
        <?php $data = array( 'name' => 'prazoresppart', 
        	'placeholder' => "Prazo de resposta (em dias) do autor a uma nova submissão", 
            'class' => 'form-control estilo-input',
             'value' => (isset($regra) ? $regra->regr_qtd_max_subm_part : ''));
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-open-file"></span> Adicionar Diretrizes de Submissão</a>
	</div>
</div>


<h4 class="subtitulo"><i>Regras de Revisão</i></h4><br>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de abertura das revisões', 'datainiciorev' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datainiciorev', 'placeholder' => "Data de abertura de submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? desconverteDataMysql($regra->regr_subm_abert) : ''));
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
        <b><?php echo form_label( '*Data de encerramento das revisões', 'datafimrev' ); ?></b>
        <div class="input-group date" data-provide="datepicker">
        <?php $data = array( 'name' => 'datafimrev', 'placeholder' => "Data de encerramento das submissões", 
            'class' => 'form-control estilo-input datepicker',
             'value' => (isset($regra) ? desconverteDataMysql($regra->regr_subm_encerr) : '') );
               echo form_input($data);?>
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
          </span>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
        <b><?php echo form_label( '*Prazo de resposta (em dias) do revisor a uma nova submissão', 'prazoresprev' ); ?></b>
        <?php $data = array( 'name' => 'razoresprev', 
        	'placeholder' => "Prazo de resposta (em dias) do revisor a uma nova submissão", 
            'class' => 'form-control estilo-input',
             'value' => (isset($regra) ? $regra->regr_qtd_max_subm_part : ''));
               echo form_input($data);?>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<a href="#" class="btn btn-default"><span class="glyphicon glyphicon-open-file"></span> Adicionar Diretrizes de Revisão</a>
	</div>
</div>

<?php echo "<br><center>".form_submit("btn_atualizar", 'Salvar',array('class' => 'btn btn-success button'))."</center>";

echo form_close();
?>

</div>