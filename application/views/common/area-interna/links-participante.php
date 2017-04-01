<hr>
<li class="<?php if($paginacorrente == 'index') {echo 'active';} ?>">
    <a href="<?php echo base_url("usuario/inicioParticipante");?>"><span class="glyphicon glyphicon-home"></span>  INÍCIO</a>
</li>
<hr>
<li class="<?php if($paginacorrente == 'meuperfil') {echo 'active';} ?>">
    <a href="<?php echo base_url("usuario/perfil");?>"><span class="glyphicon glyphicon-user"></span>  MEU PERFIL</a>
</li>
<hr>
<li class="<?php if($paginacorrente == 'novoartigo') {echo 'active';} ?>">
    <a href="<?php echo base_url('artigo/cadastrar');?>"><span class="glyphicon glyphicon-open-file"></span>  NOVO ARTIGO</a>
</li>
<hr>
<li class="<?php if($paginacorrente == 'meusartigos') {echo 'active';} ?>">
    <a href="<?php echo base_url("artigo/consultarTudo");?>"><span class="glyphicon glyphicon-list"></span>  MEUS ARTIGOS</a>
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