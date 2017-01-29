<div id="inicio">
<!-- Carousel -->
<div id="myCarousel" class="carousel slide-carousel" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="http://192.168.1.4/submissao/assets/img/semcitec01.jpg"
      width="3543px" height="1181px" alt="Chania">
    </div>

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!--/Carousel-->
</div>

<!-- Container (Sobre Section) -->
<div id="sobre" class="container-fluid">
  <div class="row vertical-center">
    <div class="col-sm-8">
      <h3 style="color:#00b300; font-weight: bold;text-transform: uppercase;"><center>Sobre</center></h3><br>
      <blockquote class="text-justify">
      Otimize o seu tempo com essa ferramenta que organiza tudo para você!
      </blockquote>
      <p class="text-justify">O IFEvents é uma poderosa ferramenta que permite a gestão de eventos científicos (congressos, seminários, palestras, workshops, etc) de uma forma mais simples e prática, voltada especialmente para as necessidades do Instituto Federal de Educação, Ciência e Tecnologia de São Paulo, Câmpus Guarulhos.</p><br>
      <p class="text-justify" >O IFEvents oferece suporte para a criação de eventos com controle de presença e emissão de certificados além de também proporcionar o controle de submissões e avaliações de trabalhos científicos. Tudo isso com muita qualidade e de forma gratuita.</p>
    </div>
    <div class="col-sm-4">
        <img src="http://192.168.1.4/layout/assets/img/logosobre.png" class="slideanim img-responsive center-block" width="300px" height="300px">
    </div>
  </div>
</div>


<!-- Container (Eventos Section) -->
<div id="contato" class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h3 style="color: white; font-weight: bold;text-transform: uppercase;"><center>Contato</center></h3><br>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8" style="background-color:#fff; padding:30px;border-radius:20px;">
          <form action="#" role="form" class="formsignin" method="post" accept-charset="utf-8">
            <div class="row">
              <div class="col-sm-6">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
                        </div>
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" name="email" placeholder="E-mail">
                        </div>
                    </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="assunto">Assunto</label>
                            <input type="text" class="form-control" name="assunto" placeholder="Assunto">
                        </div>
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" placeholder="Telefone">
                        </div>
                    </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="mensagem">Mensagem</label>
                            <textarea class="form-control" name="mensagem" placeholder="Mensagem" rows="5"></textarea>
                        </div>
                    </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 text-center">
                <br>
                <input type="submit" name="enviar" value="Enviar" class="btn btn-success" />
                <input type="reset" name="limpar" value="Limpar" class="btn btn-danger" />
              </div>
            </div>

          </form>  
        </div>
      </div>
    </div>
  </div>
</div>