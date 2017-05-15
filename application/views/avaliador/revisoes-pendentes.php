<div class="container-fluid">
<h2><span class="fa fa-files-o"></span><b> Revisões Pendentes</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('modalidade/consultar'); ?>">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" class="form-control estilo-botao-busca" 
               placeholder="Buscar por Título de Trabalho...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
</form>
<div class="row">
    <div class="col-sm-12">
         <div style="float:right" class="btn-group">
          <a  class="btn btn-default dropdown-toggle margin-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="glyphicon glyphicon-save-file" aria-hidden="true"></i> Regras de Avaliação <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#">5ª SEMCITEC</a></li>
          </ul>
        </div>
    </div>
</div>
<br><br>
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
<!--             <?php 
            //if(!empty($modalidades)){
            //foreach( $modalidades as $modalidade ): ?> -->
                 <tr> 
                    <td></td>
                    <td></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href=" base_url('modalidade/alterar/'.$modalidade->mote_cd); ?>" class="btn-opcao">
                          <span class="glyphicon glyphicon-copy"></span>&#09;Prescrever Parecer</a><br>
                          <a href=" base_url('modalidade/alterar/'.$modalidade->mote_cd); ?>" class="btn-opcao">
                          <span class="glyphicon glyphicon-eye-open"></span>&#09;Detalhar Trabalho</a><br>
                          <a href=" base_url('modalidade/alterar/'.$modalidade->mote_cd); ?>" class="btn-opcao">
                          <span class="glyphicon glyphicon-save-file"></span>&#09;Última versão do trabalho</a>
                    </div>
                    </td>
                </tr>
            <!-- <?php //endforeach;}else{ ?> -->
              <tr>
                <td class="col-xs-12 text-center" colspan="5">Não foram encontrados resultados para a sua busca...</td>
              </tr>
<!--             <?php //} ?> --> 
        </tbody>
    </table>
</div><!-- /TABELA-->

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
