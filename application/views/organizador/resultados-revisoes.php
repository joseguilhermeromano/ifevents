<div class="container-fluid">
<h2><span class="fa fa-clipboard"></span><b> Resultados das Revisões</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('revisao/consultar-resultados'); ?>">
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
         <a class="btn btn-default margin-button" href='<?= base_url('revisao/divulgar-varios-resultados') ?>' style="float:right">
         <i class="fa fa-paper-plane" aria-hidden="true" ></i> Divulgar Resultados</a>
    </div>
</div>
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>                 
                <th class="col-xs-4">Título do Trabalho</th>
                <th class="text-center col-xs-3">Revisado por</th>
                <th class="text-center col-xs-2">Situação</th>
                <th class="text-center col-xs-3">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($itens)){
            foreach( $itens as $resultado ): ?>
                 <tr> 
                    <td><?= $resultado->arti_title; ?></td>
                    <td class="text-center">
                        <?= $resultado->user_nm; ?>
                    </td>
                    <td class="text-center">
                        <?= $resultado->aval_status; ?>
                    </td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                        <a href="<?= base_url('artigo/detalhes-do-trabalho/'.$resultado->arti_cd); ?>" class="btn-opcao">
                        <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                        <a href="<?= base_url('revisao/emitir-parecer/'.$resultado->aval_subm_cd); ?>" class="btn-opcao">
                        <span class="fa fa-pencil-square-o"></span>&#09;Emitir parecer final</a><br>
                        <a href="<?= base_url('revisao/divulgar-resultado/'.$resultado->aval_cd); ?>" class="btn-opcao">
                        <i class="fa fa-paper-plane" aria-hidden="true" ></i>&#09;Divulgar Resultado</a><br>
                    </div>
                    </td>
                </tr>
            <?php endforeach;}else{ ?>
              <tr>
                <td class="col-xs-12 text-center" colspan="4">Não foram encontrados resultados para a sua busca...</td>
              </tr>
            <?php } ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->

  <!-- PAGINAÇÃO -->
    <div class="text-center">
    Exibindo de 1 a <?php echo !empty($itens) ? sizeof($itens) : 0; ?> 
    de um total de <?php echo !empty($itens) ? $totalRegistros : 0; ?> registros
    </div>
    <?= isset($paginacao) ? $paginacao : ''; ?>
  <!--/ PAGINAÇÃO -->

</div>
