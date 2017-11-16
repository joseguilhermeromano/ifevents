<div id="inicio">
  <div class="inicio-header">
    <div class="banner">
      <img class="img-responsive banner-image" src="<?php echo base_url("assets/area-externa/img/banner-index.jpg"); ?>" width="100%">
    </div>
    <div class="display-middle margin-top">
      <h4>EVENTOS</h4>
      <h1>A GENTE FAZ<br>
      ACONTECER</h1>
      <hr>
        <!-- arrow bounce --> 
        <div class="agileits-arrow bounce animated"><a href="#eventos" class="scroll"><i class="glyphicon glyphicon-menu-down" aria-hidden="true"></i></a></div>
        <!-- //arrow bounce -->
    </div>
  </div>
</div>

<!-- Container (Eventos Section) -->
<div id="eventos" class="section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="estilo-h1">Eventos Recentes</h1><br><br>
        <!-- Evento Atual -->
        <div class="col-md-10 col-md-offset-1">
        <div id="carouselEventos" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
               <?php 
                    $i = 0;
                    foreach($tresUltimosEventos as $evento): 
                    $active = $i == 0 ? 'active' : ''; 
               ?>
                        <li data-target="#carouselEventos" data-slide-to="<?= $i; ?>"
                            class="<?= $active ?>">
                        </li>
              <?php 
                    $i++;
                    endforeach; 
              ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php 
                    $i = 0;
                    foreach($tresUltimosEventos as $evento): 
                    $active = $i == 0 ? 'active' : ''; 
               ?>
                    <div class="item <?= $active; ?>">
                        <a href="<?php echo base_url($evento->edic_link);?>">
                          <img src="<?php echo base_url($evento->edic_img); ?>" 
                           alt="Chania">
                        </a>
                    </div>
              <?php 
                    $i++;
                    endforeach; 
              ?>
              
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#carouselEventos" role="button" data-slide="prev">
              <span class="fa fa-chevron-circle-left"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="right carousel-control" href="#carouselEventos" role="button" data-slide="next">
              <span class="fa fa-chevron-circle-right"></span>
              <span class="sr-only">Próximo</span>
            </a>
          </div>
        <!-- /Evento Atual -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <br><br>
        
        <?php if(!empty($todasEdicoes) && !empty($todasConferencias)): ?>
        <h1 class="estilo-h1">Todos os Eventos</h1><br>
        
        <?php foreach($todasConferencias as $conf): ?>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
           <div class="panel-group" id="#acordation_<?= $conf->conf_cd; ?>">
              <div class="panel panel-default">
                <div class="panel-heading accordion-caret">
                  <h4 class="panel-title"><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#acordation_<?= $conf->conf_cd; ?>" href="#collapseOne_<?= $conf->conf_cd; ?>"><?= $conf->conf_abrev; ?></a></h4>
                </div>
                <div id="collapseOne_<?= $conf->conf_cd; ?>" class="panel-collapse collapse">
                  <div class="panel-body">
                      <?= $conf->conf_desc; ?><br><br>
                      <b><h6>Lista de Edições do evento</h6></b><br>
                      <?php foreach($todasEdicoes as $ev): ?>
                      
                      <?php if($ev->edic_conf_cd == $conf->conf_cd ): ?>
                      
                      <?= $ev->edic_num; ?>º <?= $conf->conf_abrev; ?>:
                      <?php $link = base_url($ev->edic_link); ?>
                      <a target="_blanck" href=<?= $link; ?>><?= $link; ?></a><br>
                      
                      <?php endif; ?>
                      
                      <?php endforeach; ?>
                  
                  </div>
                </div>
              </div>
           </div>
         </div>
        </div>
        <?php endforeach; 
            endif;
        ?>
        
      </div>
    </div>
  </div>
</div>

