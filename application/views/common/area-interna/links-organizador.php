<li class="item-menu">
    <a href="<?php echo base_url("usuario/inicioOrganizador");?>">
        <span class="glyphicon glyphicon-home"></span>  INÍCIO
    </a>
</li>
<li class="list-group panel">
  <a href="#" data-toggle="collapse" data-target="#usuarios" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="glyphicon glyphicon-user"></span> USUÁRIOS <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="usuarios">
      <li><a href="<?php echo base_url("usuario/cadastrar");?>" class="list-group-item">NOVO USUÁRIO</a></li>
    </ul>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("usuario/perfil");?>">
        <span class="glyphicon glyphicon-user"></span>  MEU PERFIL
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("organizador/listatodassubmissoes");?>">
        <span class="glyphicon glyphicon-list"></span>  SUBMISSÕES
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("organizador/listaconferencia");?>">
        <span class="glyphicon glyphicon-list"></span>  CONFERÊNCIAS
    </a>
</li>
 <li class="item-menu">
    <a href="<?php echo base_url("comite/cadastrar");?>">
        <span class="glyphicon glyphicon-list"></span>  NOVO COMITÊ
    </a>
</li>
<li class="item-menu">
   <a href="<?php echo base_url("organizador/enviaConvite");?>">
        <span class="glyphicon glyphicon-list"></span>  CONVITES
   </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("login/sair");?>">
        <span class="glyphicon glyphicon-log-out"></span>  SAIR
    </a>
</li>