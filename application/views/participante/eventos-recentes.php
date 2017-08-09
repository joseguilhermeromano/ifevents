<div class="container-fluid">
<h2><span class="fa fa-flask"></span><b> Eventos Recentes</b></h2>
<hr>
<br>
<div class="row">
 <?php 
            $eventosRecentes = $this->session->userdata('eventos_recentes');
            $numeroColunas = 2;
            $linhas = 0;
            if($eventosRecentes !== null){  

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
  <br><br>
  <a href='<?= base_url($this->uri->segment(1)."/consultar/"); ?>' class='btn btn-default button'>Voltar</a>
</div>