
<?php if ($this->session->userdata('evento_selecionado') !== null && $this->session->userdata('eventos_recentes') !== null ){

?>

<li class="list-group panel" >
  <a href="#" data-toggle="collapse" data-target="#selecionarEvento" data-parent="#sidenav" class="list-group-item list-group-item-success">

  <?php
    $even = $this->session->userdata('evento_selecionado');
    echo  'Evento: '.$even->edic_num.'ª '.$even->conf_abrev;
  ?>

  <span class="caret"></span>
  </a>
    <ul class="submenu collapse" id="selecionarEvento">

    <?php
        foreach ($this->session->userdata('eventos_recentes') as $key => $evento) {
    ?>
          <li><a href="<?php echo base_url('edicao/selecionar-evento/'.$evento->edic_cd);?>" class="list-group-item">
          <?= $evento->edic_num.'ª '.$evento->conf_abrev; ?>
          </a></li>
    <?php
        }
    ?>

    </ul>
</li>

<?php } ?>


<li class="item-menu">
    <a href="<?php echo base_url("organizador/inicio");?>">
        <span class="glyphicon glyphicon-home"></span>  INÍCIO
    </a>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("organizador/perfil");?>">
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
      <li><a href="<?php echo base_url("comite/consultar");?>" class="list-group-item">COMITÊS</a></li>
      <li><a href="<?php echo base_url("instituicao/consultarTudo");?>" class="list-group-item">INSTITUIÇÕES</a></li>
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
    <a href="<?php echo base_url("atividade/consultarTudo");?>">
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
       <li><a href="<?php echo base_url("regra-submissao/consultar");?>" class="list-group-item">REGRAS</a></li>
      <li id="modalidade" class="item-menu">
      <a href="<?php echo base_url('modalidade/consultar');?>" class="list-group-item">MODALIDADES</a></li>
      <li id="eixo-tematico"><a href="<?php echo base_url('eixo-tematico/consultar');?>" class="list-group-item">EIXOS TEMÁTICOS</a></li>
      <li><a href="<?php echo base_url("revisao/consultar-atribuicoes");?>" class="list-group-item">ATRIBUIÇÃO DE SUBMISSÕES</a></li>
      <li><a href="<?php echo base_url("regra-submissao/consultar");?>" class="list-group-item">RESULTADOS</a></li>
      <li id="revisor"><a href="<?php echo base_url("revisor/consultaRevisoresAtribuicao");?>" class="list-group-item">REVISORES</a></li>
  </ul>
</li>
<li class="item-menu">
    <a href="<?php echo base_url("contato/consultarTudo");?>">
        <span class="glyphicon glyphicon-envelope"></span>  CONTATOS
    </a>
</li>

<li class="item-menu">
    <a href="<?php echo base_url("login/sair");?>">
        <span class="fa fa-power-off"></span>  SAIR
    </a>
</li>
