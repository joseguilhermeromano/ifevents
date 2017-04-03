<div class="container-fluid">
<h2><span class="glyphicon glyphicon-list"></span><b> Usuários</b></h2>
<hr>
<br>
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
         <a class="btn btn-default margin-button" href='<?php echo site_url('/usuario/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Novo Usuário</a>
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
            foreach( $users as $user ):?>
                <tr>
                    <td><?php echo $user->user_nm; ?></td>
                    <td><?php echo $user->email_email; ?></td>
                    <td class="text-center"><?php echo $user->tius_nm; ?></td>
                    <td class="text-center"><?php echo $user->stat_nm; ?></td>
                    <td class="text-center">
                      <a href="#"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a>
                      <a href="#"><span class="glyphicon glyphicon-trash estilo-botao-exclusao"></span></a>
                    </td>
                </tr>
            <?php endforeach;}else{ ?>
              <tr>
                <td class="col-xs-12 text-center" colspan="5">Não foram encontrados resultados para a sua busca...</td>
              </tr>
            <?php } ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->

  <!-- PAGINAÇÃO -->
    <?php echo $paginacao; ?>
  <!--/ PAGINAÇÃO -->

</div>
