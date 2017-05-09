<div class="container-fluid">
<h2><span class="fa fa-calendar"></span><b> Edições</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('edicao/consultar'); ?>">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" class="form-control estilo-botao-busca" 
               placeholder="Buscar por Denominação...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
</form>
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/edicao/cadastrar'); ?>' style="float:right">
         <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Nova Edição</a>
    </div>
</div>
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th class="col-xs-3">Conferência</th>
                    <th class="col-xs-2">Edição</th>
                    <th class="col-xs-1 text-center">Início</th>
                    <th class="col-xs-1 text-center">Término</th>
                    <th class="col-xs-1 text-center">Anais</th>
                    <th class="col-xs-1 text-center">Resultados</th>
                    <th class="text-center" style="width:auto">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            //if(!empty($users)){
           // foreach( $users as $user ): ?>
                 <tr> 
                    <td>Semana da Tecnologia, Ciência e Inovação</td>
                    <td><?php //echo $user->email_email; ?>SEMCITEC5</td>
                    <td class="text-center"><?php //echo $user->tius_nm; ?> 16/04/2017</td>
                    <td class="text-center"><?php //echo $user->stat_nm; ?>16/04/2017</td>
                    <td class="text-center"><?php //echo $user->stat_nm; ?>Não submetido</td>
                    <td class="text-center"><?php //echo $user->stat_nm; ?>Não submetido</td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href="<?php //echo base_url('usuario/alterar/'.$user->user_cd); ?>" class="btn-opcao">
                          <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                          <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                          onclick="setCodigo('<?php //echo $user->user_cd; ?>'); 
                          setLink('<?php //echo base_url('usuario/desativar/')?>');">
                          <span class="fa fa-trash"></span>&#09;Excluir</a><br>
                          <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                          onclick="setCodigo('<?php //echo $user->user_cd; ?>'); 
                          setLink('<?php //echo base_url('usuario/desativar/')?>');">
                          <span class="glyphicon glyphicon-open-file"></span>&#09;Upload Anais & Resultados</a>
                    </div>
                    </td>
                </tr>
            <?php //endforeach;}else{ ?>
              <tr>
                <td class="col-xs-12 text-center" colspan="7">Não foram encontrados resultados para a sua busca...</td>
              </tr>
            <?php //} ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->

  <!-- PAGINAÇÃO -->
    <div class="text-center">
    Exibindo de 1 a <?php //echo !empty($users) ? sizeof($users) : 0; ?> de um total de <?php //echo !empty($users) ? $totalRegistros : 0; ?> registros
    </div>
    <?php //echo $paginacao; ?>
  <!--/ PAGINAÇÃO -->

</div>