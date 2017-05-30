<?php
include("application/views/common/area-externa/header-presentation.php");
?>

<div id ="programacao" class="section">
   <div class="container">
   <h1 class="estilo-h1">PROGRAMAÇÃO</h1>
   <br>

   <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading accordion-caret">
          <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">SEGUNDA-FEIRA 17/10/2016</a></h4>
        </div>
    <?php foreach($programacao as $atividade): ?>

        <div id="collapseOne" class="panel-collapse collapse in">
          <div class="panel-body">
            <hr class="hr-pontilhado">
            <h4><?php echo $atividade->ativ_nm; ?></h4>

            <hr>
            <div class="row">
              <div class="col-md-3">
                  <i class="fa fa-calendar" aria-hidden="true"></i> Data: <?php echo date("d/m/Y", strtotime($atividade->ativ_dt)); ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-users" aria-hidden="true"></i> Vagas: <?php echo $atividade->ativ_vagas_qtd; ?>

              </div>
              <div class="col-md-3">
                  <i class="fa fa-clock-o" aria-hidden="true"></i> Início: <?php echo date("H:i", strtotime($atividade->ativ_hora_ini)); ?>
                  &nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> Término: <?php echo date("H:i", strtotime($atividade->ativ_hora_fin)); ?>
              </div>
              <div class="col-md-3">
                  <span class="glyphicon glyphicon-hourglass"></span> Duração: 120 min
                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker" aria-hidden="true"></i> Sala: <?php echo $atividade->ativ_local; ?>
              </div>
              <div class="col-md-3">
                  <i class="fa fa-check-square-o" aria-hidden="true"></i> Categoria: Workshop
              </div>
            </div>
            <br><br>
            <i class="fa fa-users" aria-hidden="true"></i> Responsável: <?php echo $atividade->ativ_responsavel; ?>

            <br><br>
            <p>
            Descrição...<?php echo $atividade->ativ_desc; ?>
            </p>
            <hr class="hr-pontilhado">
            <br>
            <a class="btn btn-primary margin-button" href="<?php echo base_url('/inscricao/'); ?>" style="float:right"><span class="fa fa-check-square-o" aria-hidden="true"></span> Inscrever-se</a>
          </div>
        </div>

    <?php endforeach; ?>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading accordion-caret">
          <h4 class="panel-title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">TERÇA-FEIRA 18/10/2016</a></h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
          <div class="panel-body">
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading accordion-caret">
          <h4 class="panel-title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">QUARTA-FEIRA 19/10/2016</a></h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
          <div class="panel-body">QUINTA-FEIRA 20/10/2016</div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading accordion-caret">
          <h4 class="panel-title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">SEXTA-FERA 21/10/2016</a></h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse">
          <div class="panel-body">Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra ultricies in, diam. Sed arcu. Cras consequat.</div>
        </div>
      </div>
    </div>

   </div>
</div>
