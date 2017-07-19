<h2><span class="glyphicon glyphicon-home"></span><b> Início</b></h2>
<hr>
<br>
<p>Olá, Sr(a) Organizador(a) <b><?= $this->session->userdata('usuario')->user_nm; ?></b>! Seja bem vindo à plataforma <b>IFEVENTS!</b></p><br>
<h4><span class="glyphicon glyphicon-calendar"></span><b> Indicadores</b></h4><br>
<div class="row">
<div class="col-md-3 col-sm-4 col-xs-12">
    <a href="#">
    <div class="panel panel-info">
      <!-- Default panel contents -->
      <div class="panel-heading">
      <div class="row">
      <div class="col-xs-6">
        <span class="glyphicon glyphicon-open-file" style="font-size: 55pt; padding: 18px"></span>
      </div>
      <div class="col-xs-6" style="text-align: left"><span style="font-size: 24pt"><b>30</b></span> Trabalhos Submetidos</div></div>
      </div>
    </div>
    </a>
</div>
<div class="col-md-3 col-sm-4 col-xs-12">
    <a href="#">
    <div class="panel panel-success">
      <!-- Default panel contents -->
      <div class="panel-heading">
      <div class="row">
      <div class="col-xs-6">
        <span class="glyphicon glyphicon-ok" style="font-size: 55pt; padding: 18px"></span>
      </div>
      <div class="col-xs-6" style="text-align: left"><span style="font-size: 24pt"><b>10</b></span> Trabalhos Avaliados</div></div>
      </div>
    </div>
    </a>
</div>

<div class="col-md-3 col-sm-4 col-xs-12">
    <a href="#">
    <div class="panel panel-warning">
      <!-- Default panel contents -->
      <div class="panel-heading">
      <div class="row">
      <div class="col-xs-6">
        <span class="fa fa-exclamation-triangle" style="font-size: 55pt; padding: 18px"></span>
      </div>
      <div class="col-xs-6" style="text-align: left"><span style="font-size: 24pt"><b>10</b></span> Trabalhos ainda não avaliados.</div></div>
      </div>
    </div>
    </a>
</div>
</div>

<h4><span class="glyphicon glyphicon-calendar"></span><b> Datas Importantes</b></h4><br>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <div class="postit-data">
                        25
                    </div>
                    <div class="postit-mes-ano">
                        jun 2017
                    </div>
                    <div class="postit-detalhes">
                        Data inicial do evento
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
                        jun 2017
                    </div>
                    <div class="postit-detalhes">
                        Data final do evento.
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
                        jun 2017
                    </div>
                    <div class="postit-detalhes">
                        Data de início de submissões
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
                        jun 2017
                    </div>
                    <div class="postit-detalhes">
                        Data de início de avaliações
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br>
<h4><span class="glyphicon glyphicon-alert"></span><b> Notificações</b></h4>
<br>
<div class="alert alert-success" role="alert">
  <strong>Well done!</strong> You successfully read this important alert message.
</div>
<div class="alert alert-info" role="alert">
  <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
</div>
<div class="alert alert-warning" role="alert">
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>
<div class="alert alert-danger" role="alert">
  <strong>Oh snap!</strong> Change a few things up and try submitting again.
</div>


