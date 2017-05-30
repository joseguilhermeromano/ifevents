<div class="container-fluid">
<h2 class="titulo-pagina"><span class="fa fa-users"></span><b> Usuários</b></h2>
<hr>
<br>
<?php
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('usuario/consultar'); ?>">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" class="form-control estilo-botao-busca" placeholder="Buscar por Nome...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
</form>
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/usuario/notificar'); ?>' style="float:right"><span class="fa fa-exclamation-triangle"></span> Notificar Usuários</a>
        <div style="float:right" class="btn-group">
          <a  class="btn btn-default dropdown-toggle margin-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Novo Usuário <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url('participante/cadastrar'); ?>">Participante</a></li>
            <li><a href="<?= base_url('revisor/cadastrar'); ?>">Revisor</a></li>
            <li><a href="<?= base_url('organizador/cadastrar'); ?>">Organizador</a></li>
          </ul>
        </div>
    </div>
</div>
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>

                    <th class="col-xs-3">Nome Completo</th>
                    <th class="col-xs-3">Email</th>
                    <th class="col-xs-2 text-center">Tipo de Acesso</th>
                    <th class="col-xs-1 text-center">Status</th>
                    <th class="col-xs-3 text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($users)){
            foreach( $users as $user ){ ?>


                <tr>
                    <td><?php echo $user->user_nm; ?></td>
                    <td><?php echo $user->email_email; ?></td>
                    <td class="text-center"><?php echo $user->tius_nm; ?></td>
                    <td class="text-center"><?php echo $user->user_status; ?></td>
                    <td class="text-center">
                      <div class="text-left" style="display: inline-block">
                          <a class="btn-opcao" href="<?php echo base_url(strtolower($user->tius_nm).'/alterar/'.$user->user_cd); ?>">
                          <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                          <?php if($user->user_status != 'Ativo'){ ?>
                            <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalAtivar" 
                            onclick="setCodigo('<?php echo $user->user_cd; ?>');
                            setLink('<?php echo base_url("usuario/ativar/")?>');">
                            <span class="glyphicon glyphicon-ok"></span>&#09;Ativar</a><br>
                          <?php }?>
                          <?php if($user->user_status != 'Inativo'){ ?>
                            <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalDesativar"
                            onclick="setCodigo('<?php echo $user->user_cd; ?>'); 
                            setLink('<?php echo base_url('usuario/desativar/')?>');">
                            <span class="glyphicon glyphicon-remove"></span>&#09;Desativar</a>
                          <?php }?>
                      </div>
                    </td>
                </tr>


            <?php } }else{ ?>


              <tr>
                <td class="col-xs-12 text-center" colspan="5">Não foram encontrados resultados para a sua busca...</td>
              </tr>

            <?php } ?>
        </tbody>
    </table>
</div><!-- /TABELA-->

  <!-- PAGINAÇÃO -->
    <div class="text-center">
    Exibindo de 1 a <?php echo !empty($users) ? sizeof($users) : 0; ?> de um total de <?php echo !empty($users) ? $totalRegistros : 0; ?> registros
    </div>
    <?php echo $paginacao; ?>
  <!--/ PAGINAÇÃO -->

</div>
