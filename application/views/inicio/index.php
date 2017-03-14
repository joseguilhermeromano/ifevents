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

        <div id="carouselEventos" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carouselEventos" data-slide-to="0" class="active"></li>
              <li data-target="#carouselEventos" data-slide-to="1"></li>
              <li data-target="#carouselEventos" data-slide-to="2"></li>
              <li data-target="#carouselEventos" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <a href="<?php echo base_url("/evento");?>">
                  <img src="<?php echo base_url("assets/area-externa/img/semcitec01.jpg"); ?>" 
                   alt="Chania">
                </a>
              </div>

              <div class="item">
                <a href="<?php echo base_url("/evento");?>">
                  <img src="<?php echo base_url("assets/area-externa/img/semcitec01.jpg"); ?>" 
                   alt="Chania">
                </a>
              </div>

              <div class="item">
                <a href="<?php echo base_url("/evento");?>">
                  <img src="<?php echo base_url("assets/area-externa/img/semcitec01.jpg"); ?>" 
                   alt="Chania">
                </a>
              </div>

              <div class="item">
                <a href="<?php echo base_url("/evento");?>">
                  <img src="<?php echo base_url("assets/area-externa/img/semcitec01.jpg"); ?>" 
                   alt="Chania">
                </a>
              </div>
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
    <div class="row">
      <div class="col-sm-12">
        <br><br>
        <h1 class="estilo-h1">Todos os Eventos</h1><br>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
           <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading accordion-caret">
                  <h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">NOME DA CONFERÊNCIA</a></h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">LINKS PARA AS EDIÇÕES!</div>
                </div>
              </div>
           </div>
         </div>
        </div>
        <nav class="text-center">
          <ul class="pagination pagination-sm">
            <li class="page-item">
              <a class="page-link" href="#" tabindex="-1"><<</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">>></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

