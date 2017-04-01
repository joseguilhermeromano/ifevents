<hr>
<li class="<?php if($paginacorrente == 'index' || empty($paginacorrente)) {echo 'active';} ?>">
    <a href="<?php echo base_url("usuario/inicioAvaliador");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
</li>
<hr>
<li class="<?php if($paginacorrente == 'meuperfil') {echo 'active';} ?>">
    <a href="<?php echo base_url("usuario/perfil");?>"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
</li>
<hr>
<li class="<?php if($paginacorrente == 'listaartigosativos') {echo 'active';} ?>">
    <a href="<?php echo base_url("avaliador/listaartigosativos");?>"><span class="glyphicon glyphicon-list"></span>  ARTIGOS ATIVOS</a>
</li>
<hr>
<li class="<?php if($paginacorrente == 'contato') {echo 'active';} ?>">
    <a href="<?php echo base_url("contato/cadastrar");?>"><span class="glyphicon glyphicon-envelope"></span>  CONTATO</a>
</li>
<hr>
<li class="">
    <a href="<?php echo base_url("login/sair");?>"><span class="glyphicon glyphicon-log-out"></span>  SAIR</a>
</li>
<hr>