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
<li class="item-menu">
    <a href="<?php echo base_url("usuario/consultar");?>">
        <span class="glyphicon glyphicon-user"></span>  USUÁRIOS
    </a>
</li>
<li class="list-group panel">
  <a href="#" data-toggle="collapse" data-target="#eventos" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="glyphicon glyphicon-list"></span> EVENTOS <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="eventos">
      <li><a href="<?php echo base_url("");?>" class="list-group-item">CONFERÊNCIAS</a></li>
      <li><a href="<?php echo base_url("");?>" class="list-group-item">EDIÇÕES</a></li>
      <li><a href="<?php echo base_url("");?>" class="list-group-item">PROGRAMAÇÕES</a></li>
    </ul>
</li>


<!-- <li class="list-group panel">
  <a href="#" data-toggle="collapse" data-target="#teste" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="glyphicon glyphicon-user"></span> USUÁRIOS <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="teste">
      <li><a href="<?php echo base_url("");?>" class="list-group-item">NOVO USUÁRIO</a></li>
    </ul>
</li> -->
<li class="item-menu">
    <a href="<?php echo base_url("organizador/listatodassubmissoes");?>">
        <span class="glyphicon glyphicon-list"></span>  ATIVIDADES
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("organizador/listatodassubmissoes");?>">
        <span class="glyphicon glyphicon-list"></span>  TRABALHOS
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("organizador/listaconferencia");?>">
        <span class="glyphicon glyphicon-list"></span>  CONTATOS
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("login/sair");?>">
        <span class="glyphicon glyphicon-log-out"></span>  SAIR
    </a>
</li>