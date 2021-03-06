<div class="container-fluid">
<h2><span class="fa fa-users"></span><b> Revisores</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('revisor/consultar-revisores'); ?>" name="form-busca">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>" class="form-control estilo-botao-busca" 
               placeholder="Buscar por nome de Revisor...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" data-toggle="modal" data-target="#convidarRevisor" href='#' style="float:right">
         <i class="fa fa-paper-plane" aria-hidden="true" ></i> Convidar Revisores</a>
    </div>
</div>
  <br><br>
  <div class="row">
        <div class="col-lg-2 col-lg-offset-10 
             col-md-3 col-md-offset-9 
             col-sm-4 col-sm-offset-8 
             col-xs-6 col-xs-offset-6
             form-group">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                    <p style="font-size: 13px; margin-top:10px">
                        <?php echo form_label( 'Registros:', 'limite'); ?>
                    </p>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <select name="limitereg" id="limitereg" class="selectComum form-control estilo-input" onchange="document.forms['form-busca'].submit();">
                        <option value="10" <?= $limiteReg == "10" ? 'selected' : ''?>>10</option>
                        <option value="25" <?= $limiteReg == "25" ? 'selected' : ''?>>25</option>
                        <option value="50" <?= $limiteReg == "50" ? 'selected' : ''?>>50</option>
                        <option value="100" <?= $limiteReg == "100" ? 'selected' : ''?>>100</option>
                        <option value="500"<?= $limiteReg == "500" ? 'selected' : ''?> >500</option>
                        <option value="0"<?= $limiteReg == "0" ? 'selected' : ''?> >Tudo</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row" id="ListagemRegistros">
    <div class="col-md-12" id="RegistrosPagina">
        <div class="table-responsive"><!-- TABELA-->
            <table class="table ls-table" id="tabela1">
                <thead>
                    <tr>

                            <th class="col-xs-2">Nome</th>
                            <th class="text-center col-xs-2">Modalidades</th>
                            <th class="text-center col-xs-3">Eixos Temáticos</th>
                            <th class="text-center col-xs-2">Convite</th>
                            <th class="text-center col-xs-2">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($revisores)){
                    foreach( $revisores as $revisor ): ?>
                         <tr> 
                            <td><?= $revisor->user_nm; ?></td>
                            <td class="text-center">
                                <?= $revisor->modalidadesEixos->modalidades;?>
                            </td>
                            <td class="text-center">
                                <?= $revisor->modalidadesEixos->eixos;?>
                            </td>
                            <td class="text-center">
                                 <?= $revisor->edre_convite_status; ?>
                            </td>
                            <td class="text-center">
                            <div class="text-left" style="display: inline-block">
                                  <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                                  onclick="setCodigo('<?= $revisor->user_cd."/".$revisor->edre_edic_cd; ?>'); 
                                  setLink('<?= base_url('revisor/excluir-convite/')?>');">
                                  <span class="fa fa-trash"></span>&#09; Excluir</a>
                            </div>
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
            <div class="text-center">
            Exibindo de 1 a <?php echo !empty($revisores) ? sizeof($revisores) : 0; ?> de um total de <?php echo !empty($revisores) ? $totalRegistros : 0; ?> registros
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
                    <form action="<?= base_url('revisor/convidar'); ?>" method="POST">
                      <div class="modal-body">
                        <div class="form-group controls">
                          <b><?php echo form_label( 'Selecionar revisor por nome', 'revisor' ); ?></b><br>
                              <select name="revisor" class="form-control estilo-input consultaRevisores">
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
</div>
</div>
