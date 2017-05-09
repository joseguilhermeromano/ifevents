<div class="container-fluid">
<h2><span class="fa fa-list"></span><b> Eixos Temáticos</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('eixo-tematico/consultar'); ?>">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" class="form-control estilo-botao-busca" 
               placeholder="Buscar por denominação...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
</form>
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?= site_url('/eixo-tematico/cadastrar'); ?>' style="float:right">
         <i class="fa fa-plus" aria-hidden="true"></i> Novo Eixo Temático</a>
    </div>
</div>
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th class="col-xs-3">Denominação</th>
                    <th class="col-xs-4">Descrição</th>
                    <th class="text-center col-xs-3">Trabalhos Submetidos</th>
                    <th class="text-center" style="width:auto">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($areasTematicas)){
            foreach( $areasTematicas as $areaTematica ): ?>
                 <tr> 
                    <td><?= $areaTematica->mote_nm ?></td>
                    <td><?= $areaTematica->mote_desc ?></td>
                    <td class="text-center">0</td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href="<?= base_url('eixo-tematico/alterar/'.$areaTematica->mote_cd); ?>" class="btn-opcao">
                          <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                          <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                          onclick="setCodigo('<?= $areaTematica->mote_cd; ?>'); 
                          setLink('<?= base_url('eixo-tematico/excluir/')?>');">
                          <span class="fa fa-trash"></span>&#09;Excluir</a>
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
    Exibindo de 1 a <?php echo !empty($areasTematicas) ? sizeof($areasTematicas) : 0; ?> de um total de <?php echo !empty($areasTematicas) ? $totalRegistros : 0; ?> registros
    </div>
    <?= isset($paginacao) ? $paginacao : ''; ?>
  <!--/ PAGINAÇÃO -->

</div>
