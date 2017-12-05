<li class="item-menu">
    <a href="<?php echo base_url("revisor/inicio");?>">
    	<span class="glyphicon glyphicon-home"></span>  INÍCIO
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("revisor/perfil");?>">
    	<span class="glyphicon glyphicon-user"></span>  MEU PERFIL
    </a>
</li>
<li id="revisao" class="item-menu">
    <a href="<?php echo base_url("revisao/consultar");?>">
    	<span style="float:left;" class="fa fa-files-o"></span> <div style="display:inline-block">REVISÕES <br>PENDENTES</div>
    </a>
</li>
<li class="item-menu list-group panel" >
  <a href="#" data-toggle="collapse" data-target="#atividade" data-parent="#sidenav" class="list-group-item list-group-item-success">
  <span class="glyphicon glyphicon-blackboard"></span>  PROGRAMAÇÃO <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="atividade">
      <li id="atividade" class="item-menu"><a href="<?php echo base_url("atividade/consultarTudo");?>" class="list-group-item">ATIVIDADES</a></li>
      <li id="inscricao" class="item-menu"><a href="<?php echo base_url("inscricao/minhas-atividades");?>" class="list-group-item">MINHAS ATIVIDADES</a></li>
  </ul>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("contato/cadastrar");?>">
    	<span class="glyphicon glyphicon-envelope"></span>  CONTATAR
    </a>
</li>

<li class="item-menu">
    <a href="<?php echo base_url("login/sair");?>">
    	<span class="fa fa-power-off"></span>  SAIR
    </a>
</li>
