<div class="container-fluid">
<h2><span class="fa fa-files-o"></span><b> Revisões Pendentes</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('revisao/consultar'); ?>" name="form-busca">
  <div class="row">
      <div class="col-sm-4">
         <div class="input-group">
               <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>" class="form-control estilo-botao-busca" 
               placeholder="Buscar por Título de Trabalho...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
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

                            <th class="col-xs-3">Título do Trabalho (Evento)</th>
                            <th class="text-center col-xs-2">Modalidade</th>
                            <th class="text-center col-xs-3">Eixo Temático</th>
                            <th class="text-center col-xs-2">Situação</th>
                            <th class="text-center col-xs-2" style="width:auto">Opções</th>
                    </tr>
                </thead>
                <tbody>
                     <?php 
                    if(!empty($revisoes)){
                    foreach( $revisoes as $revisao ): ?> 
                         <tr> 
                            <td><?= $revisao->arti_title.' ('.$revisao->edic_num.'ª '.$revisao->conf_abrev.')'; ?></td>
                            <td class="text-center"><?= $revisao->modalidade; ?></td>
                            <td class="text-center"><?= $revisao->eixo; ?></td>
                            <td class="text-center"><?php 
                                echo $revisao->aval_status;
                                if($revisao->aval_confirm == 0 && $revisao->aval_status!= "Revisão Pendente"){
                                    echo "<br>(Resultado não confirmado)";
                                }
                            ?></td>
                            <td class="text-center">
                            <div class="text-left" style="display: inline-block">

                                  <?php if($revisao->aval_status!= "Revisão Pendente"){ ?>

                                    <a class="btn-opcao" data-toggle="modal" data-target="#modalConfirmarRevisao" 
                                    onclick="setCodigo('<?php echo $revisao->aval_cd; ?>');
                                    setLink('<?php echo base_url("revisao/confirmar-revisao/")?>');">
                                    <span class="fa fa-gavel"></span>&#09;Confirmar Resultado</a><br>

                                  <?php }?>

                                  <a href="<?= base_url('revisao/emitir-parecer/'.$revisao->aval_cd); ?>" class="btn-opcao">
                                  <span class="fa fa-pencil-square-o"></span>&#09;Emitir/Editar Parecer</a><br>
                                  <a href="<?= base_url('artigo/detalhes-do-trabalho/'.$revisao->arti_cd); ?>" class="btn-opcao">
                                  <span class="glyphicon glyphicon-eye-open"></span>&#09;Detalhar Trabalho</a><br>
                                  <a href="<?= base_url('submissao/download-artigo/'
                                . 'sem-identificacao/'.$revisao->subm_cd); ?>" class="btn-opcao">
                                  <span class="glyphicon glyphicon-save-file"></span>&#09;Última versão do trabalho</a>
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
        <?php if(!empty($revisoes)): ?>
        <!-- PAGINAÇÃO -->
        <div class="text-center">
        Exibindo de 1 a <?php echo !empty($revisoes) ? sizeof($revisoes) : 0; ?> de um total de <?php echo !empty($revisoes) ? $totalRegistros : 0; ?> registros
        </div>
        <?= isset($paginacao) ? $paginacao : ''; ?>
        <!--/ PAGINAÇÃO -->
        <?php endif; ?>
    </div>
</div>

<?php if(isset($eixosTematicos) && isset($modalidades)){ ?>
  <!-- Modal -->

  <div id="selecionarModalidadesEixos" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title"><span class="fa fa-check-square-o"></span> Selecione suas Modalidades e Eixos Temáticos</h4>
              </div>
              <form action="<?= base_url('revisao/consultar'); ?>" method="POST">
                <div class="modal-body">
                  <div class="container-fluid">
                    <?= isset($mensagem) ? $mensagem : '' ?>
                    <br>
                    <fieldset class="col-md-12">     
                      <legend>Modalidades</legend>
                      
                      <div class="panel panel-default">
                        <div class="panel-body">
                        
                          <?php foreach ($modalidades as $key => $modalidade) { ?>
                          <div>
                            <input type="checkbox" id="modalidade_<?= $key; ?>" name="modalidades[]" value="<?= $modalidade->mote_cd; ?>" <?= isset($inputmodalidades) && in_array($modalidade->mote_cd,$inputmodalidades) ? 'checked' : '' ?>>
                            <label for="modalidade"><?= $modalidade->mote_nm; ?></label>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                      
                    </fieldset>
                  </div>
                  <div class="container-fluid">
                    <fieldset class="col-md-12">     
                      <legend>Eixos Temáticos</legend>
                      
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <?php foreach ($eixosTematicos as $key => $eixo) { ?>
                          <div>
                            <input type="checkbox" id="eixo_<?= $key; ?>" name="eixos[]" value="<?= $eixo->mote_cd; ?>"
                            <?= isset($inputeixos) && in_array($eixo->mote_cd,$inputeixos) ? 'checked' : '' ?>>
                            <label for="eixo"><?= $eixo->mote_nm; ?></label>
                          </div>
                          <?php } ?>
                      </div>
                      
                    </fieldset>
                  </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
              </form>
          </div>
      </div>
  </div>
<?php } ?>

</div>
