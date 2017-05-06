<div class="container-fluid">
<h2><span class="fa fa-files-o"></span><b> Meus Trabalhos</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('artigo/consultar'); ?>">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" class="form-control estilo-botao-busca" 
               placeholder="Buscar por Título do Trabalho...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
</form>
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/artigo/cadastrar'); ?>' style="float:right">
         <i class="glyphicon glyphicon-open-file" aria-hidden="true"></i> Submeter Novo Trabalho</a>
    </div>
</div>
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th class="col-md-6">Título</th>
                    <th class="text-center">Última Modificação</th>
                    <th><center>Situação</center></th>
                    <th class="text-center"> Opções </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($itens)){
              foreach( $itens as $item ):?>
                  <tr>

                      <td><?php echo $item->arti_title; ?></td>
                      <td class="text-center">
                      <?= desconverteDataMysql($item->arti_ulti_alte_dt)." às ".date_format(date_create($item->arti_ulti_alte_hr),'H:m'); ?>
                        
                      </td>
                      <td class="text-center"><?php echo ($item->arti_status==0 ? "Pronto para a revisão" : "Aprovado"); ?></td>
                      <td class="text-left">
                        <a href="<?= base_url('edicao/alterar/'.$item->arti_cd); ?>" class="btn-opcao">
                          <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                          <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                          onclick="setCodigo('<?php //echo $user->user_cd; ?>'); 
                          setLink('<?php //echo base_url('usuario/desativar/')?>');">
                          <span class="glyphicon glyphicon-open-file"></span>&#09;Editar/Nova Submissão</a><br>
                          <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                          onclick="setCodigo(' //$edicao->edic_cd; ?>'); 
                          setLink('<?= base_url('edicao/desativar/')?>');">
                          <span class="fa fa-close"></span>&#09;Cancelar</a>
                      </td>
                  </tr>
            <?php endforeach;}else{ ?>
              <tr>
                <td class="col-xs-12 text-center" colspan="4">Não há trabalhos submetidos...</td>
              </tr>
            <?php } ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->

  <!-- PAGINAÇÃO -->
    <div class="text-center">
      <?php if (!empty($itens)){  ?>
      Exibindo de 1 a <?php echo !empty($itens) ? sizeof($itens) : 0; ?> de um total de <?php echo !empty($itens) ? 
      $totalRegistros : 0; ?> registros
      <?php } ?>
    </div>
    <?php isset($paginacao) ? $paginacao : ''; ?>
  <!--/ PAGINAÇÃO -->
</div>
