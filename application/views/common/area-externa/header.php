<!DOCTYPE html>
<html>
<title>IFEvents!</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="<?php echo base_url('assets/area-externa/css/bootstrappaper.css'); ?>" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url('assets/area-externa/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url('assets/area-externa/css/estilo.css'); ?>" rel="stylesheet" type="text/css" media="all" />
  <!-- //JavaScript --><!-- animation-effect -->
  <link href="<?php echo base_url('assets/area-externa/css/animate.min.css'); ?>" rel="stylesheet">
  <script src="<?php echo base_url('assets/area-externa/js/wow.min.js');?>"></script>
  <script>
   new WOW().init();
  </script>
  <!-- //animation-effect -->
</head>
<body id="page-top">

<!--header-->
<div class="logo_nav">

      <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header wow fadeInLeft animated animated"
        data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="fa fa-bars"></span> MENU
          </button>
            <div class="wow swing animated" data-wow-delay=".5s">
              <a href="#">
                <div class="logo img-responsive"></div>
              </a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <nav>
            <ul class="nav navbar-nav wow fadeInRight animated animated"
            data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">

              <!--Dropdowns específicos para as paginas do evento -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle hover-effect" data-toggle="dropdown" role="button" aria-expanded="false">
                <span>
                  <span>Início <b class="caret"></b></span>
                  <span class="hidden-xs">Início <b class="caret"></b></span>
                </span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("index?div=apresentacao"); ?>">Apresentação</a>

                  </li>
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("index?div=sobre"); ?>">Sobre</a></li>
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("index?div=eventos"); ?>">Eventos</a></li>
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("index?div=contato"); ?>">Contato</a></li>
                </ul>
              </li>
              <li><a href="<?php echo base_url("/login"); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" href="about.html" class="hover-effect">
                <span>
                  <span>Sobre</span>
                  <span class="hidden-xs">Sobre</span>
                </span>
              </a></li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle hover-effect" data-toggle="dropdown" role="button" aria-expanded="false">
                <span>
                  <span>Evento <b class="caret"></b></span>
                  <span class="hidden-xs">Evento <b class="caret"></b></span>
                </span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("evento?div=apresentacao"); ?>">Sobre o Evento</a></li>
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("programacao"); ?>">Programação</a></li>
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("submissao"); ?>">Submissão</a></li>
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("anaisresultados"); ?>">Anais e Resultados</a></li>
                </ul>
              </li>
              <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="about.html" class="hover-effect">
                <span>
                  <span>Cadastro</span>
                  <span class="hidden-xs">Cadastro</span>
                </span>
              </a></li>
              <li><a href="<?php echo base_url("/login"); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" href="about.html" class="hover-effect">
                <span>
                  <span>Contato</span>
                  <span class="hidden-xs">Contato</span>
                </span>
              </a></li>
              <li><a href="<?php echo base_url("/login"); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" href="about.html" class="hover-effect">
                <span>
                  <span>Login</span>
                  <span class="hidden-xs" href="">Login</span>
                </span>
              </a></li>
            </ul>
          </nav>
        </div>
        <!-- /.navbar-collapse -->
        <div><!--/.container-->
      </nav>
  </div>
<!--/header-->
