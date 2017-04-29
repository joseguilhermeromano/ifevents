<li class="list-group panel" >
  <a href="#" data-toggle="collapse" data-target="#selecionarEvento" data-parent="#sidenav" class="list-group-item list-group-item-success"> SEMCITEC5 <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="selecionarEvento">
      <li><a href="<?php echo base_url('');?>" class="list-group-item">SEMCITEC5</a></li>
      <li><a href="<?php echo base_url('edicao/consultar');?>" class="list-group-item">FECEG3</a></li>
    </ul>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("usuario/inicioOrganizador");?>">
        <span class="glyphicon glyphicon-home"></span>  INÍCIO
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("usuario/perfil");?>">
        <span class="glyphicon glyphicon-user"></span>  MEU PERFIL
    </a>
</li>
  <li class="item-menu" id="usuario">
    <a href="<?php echo base_url("usuario/consultar");?>" id="usuario">
        <span class="fa fa-users"></span>  USUÁRIOS
    </a>
</li>
<li class="item-menu list-group panel" >
  <a href="#" data-toggle="collapse" data-target="#eventos" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="fa fa-flask"></span> EVENTOS <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="eventos">
      <li class="item-menu">
      <a href="<?php echo base_url('conferencia/consultarTudo');?>" class="list-group-item">CONFERÊNCIAS</a></li>
      <li id="edicao"><a href="<?php echo base_url('edicao/consultar');?>" class="list-group-item">EDIÇÕES</a></li>
      <li><a href="<?php echo base_url("");?>" class="list-group-item">COMITÊS</a></li>
      <li><a href="<?php echo base_url("");?>" class="list-group-item">INSTITUIÇÕES</a></li>
  </ul>
</li>


<!-- <li class="list-group panel">
  <a href="#" data-toggle="collapse" data-target="#teste" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="glyphicon glyphicon-user"></span> USUÁRIOS <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="teste">
      <li><a href="<?php echo base_url("usuario/consultar");?>" class="list-group-item">LISTAR TUDO</a></li>
    </ul>
</li> -->
<li class="item-menu">
    <a href="<?php echo base_url("organizador/listatodassubmissoes");?>">
        <span class="glyphicon glyphicon-blackboard"></span>  ATIVIDADES
    </a>
</li>
<!-- <li class="item-menu">
    <a href="#">
        <span class="fa fa-files-o"></span>  TRABALHOS
    </a>
</li> -->

<li class="item-menu list-group panel" >
  <a href="#" data-toggle="collapse" data-target="#trabalhos" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="fa fa-files-o"></span>  TRABALHOS <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="trabalhos">
      <li id="modalidade" class="item-menu">
      <a href="<?php echo base_url('modalidade/consultar');?>" class="list-group-item">MODALIDADES</a></li>
      <li id="eixo-tematico"><a href="<?php echo base_url('eixo-tematico/consultar');?>" class="list-group-item">EIXOS TEMÁTICOS</a></li>
      <li><a href="<?php echo base_url("");?>" class="list-group-item">AVALIAÇÕES</a></li>
      <li><a href="<?php echo base_url("");?>" class="list-group-item">REGRAS</a></li>
  </ul>
</li>

<li class="list-group panel">
  <a href="#" data-toggle="collapse" data-target="#contatos" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="glyphicon glyphicon-list"></span> CONTATOS <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="contatos">
      <li><a href="<?php echo base_url("organizador/listaconferencia");?>" class="list-group-item">LISTA DE CONTATOS</a></li>
      <li><a href="<?php echo base_url("contato/sendEmail");?>" class="list-group-item">EMAIL</a></li>
    </ul>
</li>

<li class="item-menu">
    <a href="<?php echo base_url("login/sair");?>">
        <span class="fa fa-power-off"></span>  SAIR
    </a>
</li>
