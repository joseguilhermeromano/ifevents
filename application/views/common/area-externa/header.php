<!DOCTYPE html>
<html>
<title><?php echo($title); ?></title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="<?php echo base_url('assets/area-externa/css/bootstrappaper.css'); ?>" rel="stylesheet" type="text/css" media="all" />
  <link href="<?php echo base_url ('assets/ambas-areas/css/font-awesome.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/area-externa/css/estilo.css'); ?>" rel="stylesheet" type="text/css" media="all" />
  <!-- //JavaScript --><!-- animation-effect -->
  <link href="<?php echo base_url('assets/area-externa/css/animate.min.css'); ?>" rel="stylesheet">
<!--   <link href="<?php echo base_url ('assets/ambas-areas/css/select2.min.css');?>" rel="stylesheet"> -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

  <script src="<?php echo base_url('assets/area-externa/js/wow.min.js');?>"></script>
  <script>
   new WOW().init();
  </script>
  <script type="text/javascript">
      var baseUrl = "<?php echo base_url(''); ?>";
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
              <li><a href="<?php echo base_url("/index"); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" class="hover-effect">
                <span>
                  <span>INÍCIO</span>
                  <span class="hidden-xs">INÍCIO</span>
                </span>
              </a></li>
              <li><a href="<?php echo base_url("/sobre"); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" class="hover-effect">
                <span>
                  <span>SOBRE</span>
                  <span class="hidden-xs">SOBRE</span>
                </span>
              </a></li>

              
              <?php 
                $uri = $this->session->userdata('link_evento_selecionado');
                if(!empty($uri)){
                $partes = explode("/", $uri);
                $string = strtoupper($partes[sizeof($partes)-1]);
                $nomeEvento = str_replace("-", "º ", $string);
              ?>
              <li><a href="<?php echo base_url($uri); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" class="hover-effect">
                <span>
                  <span><?= $nomeEvento; ?></span>
                  <span class="hidden-xs"><?= $nomeEvento; ?></span>
                </span>
              </a></li>
              <?php }?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle hover-effect" data-toggle="dropdown" role="button" aria-expanded="false">
                <span>
                  <span>Cadastro <b class="caret"></b></span>
                  <span class="hidden-xs">Cadastro <b class="caret"></b></span>
                </span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("inicio/cadastrar/participante"); ?>">Participante</a></li>
                  <li><a data-toggle="collapse" data-target=".navbar-collapse.in" href="<?php echo base_url("inicio/cadastrar/revisor"); ?>">Revisor</a></li>
                </ul>
              </li>
              <li><a href="<?php echo base_url("/inicio/contato"); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" class="hover-effect">
                <span>
                  <span>CONTATO</span>
                  <span class="hidden-xs">CONTATO</span>
                </span>
              </a></li>
              <li><a href="<?php echo base_url("/login"); ?>" data-toggle="collapse" data-target=".navbar-collapse.in" class="hover-effect">
                <span>
                  <span>Login</span>
                  <span class="hidden-xs">Login</span>
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
