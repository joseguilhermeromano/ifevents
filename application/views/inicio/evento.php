<div id="header-presentation">
  <div class="header">
    <div class="banner">
      <img class="img-responsive banner-image" src="<?= base_url($evento->getImagemEdicao()); ?>" width="100%">
    </div>
  </div>
</div>

<div id ="apresentacao" class="section">
   <div class="container">
      <h1 class="estilo-h1">APRESENTAÇÃO</h1>
        <br>
            <?= $evento->getApresentacao(); ?>
   </div>
</div>

<div id ="apresentacao" class="section">
   <div class="container">
      <h1 class="estilo-h1">ORGANIZADORES</h1>
      <br>
      <div class="text-left">
      <div class="div-em-colunas">
        <?= $evento->getComite()->getEquipe(); ?>
        <br>
      </div>
      </div>
   </div>
</div>
    
    
<div id ="datasimportantes" class="section">
   <div class="container">
      <h1 class="estilo-h1">DATAS IMPORTANTES</h1>
      <br><br>
      <div class="row">
      <div class="col-sm-8 col-sm-offset-2">
        <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioSubmissao()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimSubmissao()); ?> </h1>
                    <h2>Inscrições para Submissão de Trabalhos</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioPublicacao()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimPublicacao()); ?> </h1>
                    <h2>Publicação dos trabalhos aceitos</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioEvento()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimEvento()); ?> </h1>
                    <h2>Realização da Semana</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioInscricao()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimInscricao()); ?> </h1>
                    <h2>Período de inscrição para as atividades do evento</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>Dia  <?= desconverteDataMysql($evento->getDataFimEvento()); ?></h1>
                    <h2>Encerramento e Cerimônia de premiação</h2>
                </div>
            </div>
        </div>
      </div>
    </div>
    </div>
   </div>
</div>


<!--PROGRAMAÇÃO -->

<div id ="programacao" class="section">
    <div class="container">
        <h1 class="estilo-h1">PROGRAMAÇÃO</h1>
        <br>
        <?php if(isset($programacoes)): 

           foreach($programacoes as $atividade): 

         ?>
        <div class="row">
             <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                 <div class="panel-group" id="accordion_<?= $atividade->ativ_cd; ?>">
                    <div class="panel panel-default">
                      <div class="panel-heading accordion-caret">
                        <?php $data = desconverteDataMysql($atividade->ativ_dt); ?>
                        <h4 class="panel-title"><a class="accordion-toggle collapsed" data-toggle="collapse" 
                        data-parent="#accordion_<?= $atividade->ativ_cd; ?>" href="#collapseOne_<?= $atividade->ativ_cd; ?>"><?= $atividade->DiaDaSemana.' - '.$data; ?></a></h4>
                      </div>
                      <div id="collapseOne_<?= $atividade->ativ_cd; ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                          <hr class="hr-pontilhado">
                          <h4><?= $atividade->ativ_nm; ?></h4>

                          <hr>
                          <div class="row">
                            <div class="col-md-3">
                                <i class="fa fa-calendar" aria-hidden="true"></i> Data: <?php echo date("d/m/Y", strtotime($atividade->ativ_dt)); ?>
                                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-users" aria-hidden="true"></i> Vagas: <?php echo $atividade->vagas_ocupadas."/".$atividade->ativ_vagas_qtd; ?>

                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-clock-o" aria-hidden="true"></i> Início: <?php echo date("H:i", strtotime($atividade->ativ_hora_ini)); ?>
                                &nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i> Término: <?php echo date("H:i", strtotime($atividade->ativ_hora_fin)); ?>
                            </div>
                            <div class="col-md-3">
                                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker" aria-hidden="true"></i> Local: <?php echo $atividade->ativ_local; ?>
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i> Categoria: <?= $atividade->tiat_nm; ?>
                            </div>
                          </div>
                          <br>
                          <i class="fa fa-users" aria-hidden="true"></i> Responsável: <?php echo $atividade->ativ_responsavel; ?>

                          <br><br>
                          <p>
                              <b>Descrição:</b> <?php echo $atividade->ativ_desc; ?>
                          </p>
                          <hr class="hr-pontilhado">
                          <br>
                          <a class="btn btn-primary margin-button" href="<?php echo base_url('/atividade/inscrever/'.$atividade->ativ_cd); ?>" 
                          style="float:right"><span class="fa fa-check-square-o" aria-hidden="true"></span> Inscrever-se</a>
                        </div>
                      </div>
                      </div>
                 </div>
             </div>
        </div>
         <?php 
                 endforeach;
             endif; ?>
    </div>
</div>
<!-- /PROGRAMAÇÃO -->

<!-- DIRETRIZES DE SUBMISSÃO E REVISÃO -->
<?php if(!empty($evento->getDiretrizesSubmissao())
        && !empty($evento->getDiretrizesAvaliacao())): ?>
<div id ="submissaoerevisao" class="section">
   <div class="container">
      <h1 class="estilo-h1">Submissão e Revisão</h1>
      <br>
        <center>
            <p>Clique nas opções abaixo para verificar as diretrizes de submissão e revisão de trabalhos deste evento! </p><br><br>
            <a type="button" target=“_blank” href="<?= base_url($evento->getDiretrizesSubmissao());?>" class="btn btn-success btn-circle btn-xl">
                <i class="fa fa-file"></i><br><br>Diretrizes <br>Subissão</a>
            <a type="button" target=“_blank” href="<?= base_url($evento->getDiretrizesAvaliacao());?>" class="btn btn-danger btn-circle btn-xl">
                <i class="fa fa-clipboard"></i><br><br> Diretrizes <br> Revisão</a>
        </center>
   </div>
</div>
<?php endif; ?>
<!-- /DIRETRIZES DE SUBMISSÃO E REVISÃO -->

<!-- ANAIS E RESULTADOS -->
<?php if(!empty($evento->getAnais() && !empty($evento->getResultados()))): ?>
<div id ="anaiseresultads" class="section">
   <div class="container">
      <h1 class="estilo-h1">Anais e Resultados</h1>
      <br>
        <center>
            <p>Clique nas opções abaixo para verificar os anais e os resultados dos trabalhos deste evento! </p><br><br>
            <a type="button" target=“_blank” href="<?= base_url($evento->getAnais());?>" class="btn btn-default btn-circle btn-xl">
                <br><i class="fa fa-file"></i><br><br>Anais</a>
            <a type="button" target=“_blank” href="<?= base_url($evento->getResultados());?>" class="btn btn-primary btn-circle btn-xl">
                <br><i class="fa fa-check-square-o"></i><br><br> Resultados</a>
        </center>
   </div>
</div>
<?php endif; ?>
<!-- /ANAIS E RESULTADOS -->


<!-- PARCERIAS -->
<?php if(!empty($evento->getParcerias())): ?>
<div id="parcerias" class="section">
  <div class="container">
  <div class="row">
    <h1 class="estilo-h1">Parcerias e Apoios</h1>
    <br>
  </div>
  <div class='row'>
    <div class='col-sm-10 col-sm-offset-1 horizontal-center-content-col'>
            <div class="carousel slide media-carousel" id="media">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#media" data-slide-to="0" class="active"></li>
                    <?php                 
                        $numeroColunas = 3;
                        $linhas = count($evento->getParcerias()) % $numeroColunas; 
                        $i=1;
                        foreach($evento->getParcerias() as $parceria):    
                        $i++;
                        if($linhas > 1 && $i % $numeroColunas == 0){
                    ?>
                            <li data-target="#media" data-slide-to="<?= $i; ?>"></li>
                    <?php
                        }
                        endforeach;
                    ?>
                </ol>
              <div id="carousel-inner" class="carousel-inner">
                        <div class="item  active">
                            <div class="row">
                <?php
                    $numeroColunas = 3;
                    $linhas = count($evento->getParcerias()) % $numeroColunas; 
                    $i=0;
                    foreach($evento->getParcerias() as $parceria):
                ?>
                            <div class="col-md-4 horizontal-center-content-col">
                              <a class="thumbnail"><img alt="" src="<?= base_url($parceria->getLogo()); ?>">
                                <i class="balao">
                                    <b>Instituição: </b> <?= $parceria->getNome(); ?><br><br>
                                    <b>Detalhes:</b> <?= $parceria->getDescricao(); ?><br><br>
                              </a>
                            </div>       
                <?php 
                    $i++;
                    if($linhas > 0 && $i % $numeroColunas == 0){ 
                        echo '</div></div><div class="item"><div class="row">';
                    }
                    endforeach;
                ?>
                          </div>
                        </div>
              </div>
              <a data-slide="prev" href="#media" class="left carousel-control"><span class="fa fa-chevron-circle-left"></span></a>
              <a data-slide="next" href="#media" class="right carousel-control"><span class="fa fa-chevron-circle-right"></span></a>
            </div> 
      
    </div>
  </div>
</div>
</div>
<?php endif; ?>
<!-- /PARCERIAS -->