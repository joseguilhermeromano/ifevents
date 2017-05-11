<div class="container-fluid">
<h2><span class="fa fa-users"></span><b> Revisores</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('revisor/consultar'); ?>">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" class="form-control estilo-botao-busca" 
               placeholder="Buscar por nome de Revisor...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
</form>
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" data-toggle="modal" data-target="#convidarRevisor" href='#' style="float:right">
         <i class="fa fa-paper-plane" aria-hidden="true" ></i> Convidar Revisores</a>
    </div>
</div>
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th class="col-xs-2">Nome</th>
                    <th class="text-center col-xs-4">Modalidades</th>
                    <th class="text-center col-xs-4">Eixos Temáticos</th>
                    <th class="text-center col-xs-2">Convite</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($revisores)){
            foreach( $revisores as $revisor ): ?>
                 <tr> 
                    <td><?= $revisor->user_nm; ?></td>
                    <td class="text-center"><?= $revisor->user_moda_tema_cds == null ? 'Ainda não foi informado!' : '' ; ?></td>
                    <td class="text-center"><?= $revisor->user_moda_tema_cds == null ? 'Ainda não foi informado!' : '' ; ?></td>
                    <td class="text-center">
                    <?= $revisor->edre_convite_status; ?>
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
    Exibindo de 1 a <?php echo !empty($modalidades) ? sizeof($modalidades) : 0; ?> de um total de <?php echo !empty($modalidades) ? $totalRegistros : 0; ?> registros
    </div>
    <?= isset($paginacao) ? $paginacao : ''; ?>
  <!--/ PAGINAÇÃO -->


  <!-- Modal -->

  <div id="convidarRevisor" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title"><span class="fa fa-paper-plane"> Convidar Revisores</h4>
              </div>
              <div class="modal-body">
              <form action="<?= base_url('revisor/convidar'); ?>" method="POST">
                <div class="form-group floating-label-form-group controls">
                    <b><?php echo form_label( 'Selecionar por nome de Revisor', 'revisores' ); ?></b><br>
                        <select name="revisores[]" class="form-control estilo-input consultaRevisores" multiple="multiple">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar convites</button>
                </div>
              </form>
          </div>
      </div>
  </div>

</div>
