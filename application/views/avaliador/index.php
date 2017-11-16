<div class="container-fluid">
<h2><span class="glyphicon glyphicon-home"></span><b> Início</b></h2>
<hr>
<br>
<div class="mensagem-entrada">Olá, Sr(a) Revisor(a) <b><?= $this->session->userdata('usuario')->user_nm; ?></b>! Seja bem vindo à plataforma <b>IFEVENTS!</b></div><br>
<h4><span class="glyphicon glyphicon-alert"></span><b> Indicadores de Desempenho</b></h4>
<br>
 <div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-open-file fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($totalRevisoes) ? $totalRevisoes : 0?></div>
                        <div class="font-panel"><b>Trabalhos atribuídos!</b></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('revisao/consultar') ;?>">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-exclamation-circle fa-4x"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <div class="huge"><?= isset($revisoesAndamento) ? $revisoesAndamento : 0?></div>
                        <div class="font-panel"><b>Revisões em andamento!</b></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('revisao/consultar'); ?>">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-check fa-4x"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <div class="huge"><?= isset($revisoesFinalizadas) ? $revisoesFinalizadas : 0?></div>
                        <div class="font-panel"><b>Revisões finalizadas!</b></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('revisao/consultar'); ?>">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<br><br>
<?php 
            $eventosRecentes = $this->session->userdata('eventos_recentes');
            $numeroColunas = 2;
            $linhas = 0;
            if($eventosRecentes !== null){
?>
<h4><span class="fa fa-flask"></span><b> Eventos Recentes</b></h4><br>
    <div class="row">
<?php   

                foreach($eventosRecentes as $evento):
                    
?>

            <div class="col-md-6 portfolio-item">
              <div class="box-shadow">
                <img src="<?= base_url($evento->edic_img); ?>" class="img-responsive" alt="">
                  <div class="portfolio-caption">
                      <h4><?= $evento->edic_num; ?>ª <?= $evento->conf_abrev; ?>, 
                          <span class="glyphicon glyphicon-calendar"></span>
                            <?= desconverteDataMysql($evento->regr_even_ini_dt); ?></h4>
                        <br>
                        <p class="text-justify"><?= $evento->conf_desc; ?></p>
                        <br>
                         <a href="<?= base_url('atividade/consultarTudo?busca='.$evento->edic_num.'º '.$evento->conf_abrev); ?>" 
                          class="botao-detalhar"> Inscrever em atividades</a>
                  </div>
                </div>
            </div>
        <?php 
                $linhas++;
                if($linhas % $numeroColunas == 0){ 
                    echo '</div><div class="row">';
                }
                endforeach;
            }
        ?>
    </div>
</div>


