<div class="container-fluid">
<h2><span class="glyphicon glyphicon-home"></span><b> Início</b></h2>
<hr>
<br>
<h3><span class="glyphicon glyphicon-calendar"></span><b> Datas Importantes</b></h3><br>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <div class="postit-data">
                        25
                    </div>
                    <div class="postit-mes-ano">
                        Fev 2016
                    </div>
                    <div class="postit-detalhes">
                        Entrega final do Trabalho.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <div class="postit-data">
                        26
                    </div>
                    <div class="postit-mes-ano">
                        Fev 2016
                    </div>
                    <div class="postit-detalhes">
                        Entrega final do Trabalho.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <div class="postit-data">
                        27
                    </div>
                    <div class="postit-mes-ano">
                        Fev 2016
                    </div>
                    <div class="postit-detalhes">
                        Entrega final do Trabalho.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <div class="postit-data">
                        28
                    </div>
                    <div class="postit-mes-ano">
                        Fev 2016
                    </div>
                    <div class="postit-detalhes">
                        Entrega final do Trabalho.
                    </div>
                </div>
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
<h3><span class="fa fa-flask"></span><b> Eventos Recentes</b></h3><br><br>
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
                        <p><?= $evento->edic_apresent; ?></p>
                        <br>
                         <a href="<?= base_url('artigo/cadastrar/'.$evento->edic_cd); ?>" 
                          class="botao-detalhar-cinza"> Submeter Trabalho</a>
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


