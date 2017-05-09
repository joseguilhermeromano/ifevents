<div class="container-fluid">
<h2><span class="fa fa-flask"></span><b> Eventos Recentes</b></h2>
<hr>
<br>
 <div class="row">
 	<?php foreach($eventos as $key => $evento){ ?>
    <div class="col-md-6 portfolio-item">
      <div class="box-shadow">
        <img src="<?php echo base_url($evento->edic_img); ?>" class="img-responsive" alt="">
          <div class="portfolio-caption">
              <h4><?= $evento->edic_num.'ª '.$evento->conf_abrev; ?>, De <?= desconverteDataMysql($evento->regr_even_ini_dt); ?> até <?= desconverteDataMysql($evento->regr_even_fin_dt); ?></h4>
                <br>
                <p><?= $evento->conf_desc; ?></p>
                <br>
                 <a href="<?= base_url('artigo/cadastrar/'.$evento->conf_cd); ?>" class="btn botao-detalhar-cinza">Submeter para este evento</a>
          </div>
        </div>
    </div>
    <?php }?>
  </div>
  <br><br>
  <a href='<?= base_url($this->uri->segment(1)."/consultar/"); ?>' class='btn btn-default button'>Voltar</a>
</div>