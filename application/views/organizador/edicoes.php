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
               placeholder="Buscar por Edição, ex: 1ª SEMCITEC...">
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
                    
                    <th class="text-center">Edição</th>
                    <th class="">Tema</th>
                    <th class="text-center">Início</th>
                    <th class="text-center">Término</th>
                    <th class="text-center" style="width:auto">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($edicoes)){
            foreach( $edicoes as $edicao ): ?>
                 <tr> 
                    <td class="text-center"><?= $edicao->edic_num.'ª '.$edicao->conf_abrev ?></td>
                    <td class="col-md-5"><?= $edicao->edic_tema ?></td>
                    <td class="text-center"><?= desconverteDataMysql($edicao->regr_even_ini_dt) ?></td>
                    <td class="text-center"><?= desconverteDataMysql($edicao->regr_even_fin_dt) ?></td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href="<?= base_url('edicao/alterar/'.$edicao->edic_cd); ?>" class="btn-opcao">
                          <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                          <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalUploadAnaisResultados"
                          onclick="setCodigo('<?= $edicao->edic_cd; ?>'); 
                          setLink('<?= base_url('edicao/desativar/')?>');">
                          <span class="fa fa-trash"></span>&#09;Excluir</a><br>
                          <a href="#" class="btn-opcao uploadAnaisResultados"  data-target="#modalUploadAnaisResultados"
                          codigoedicao="<?= $edicao->edic_cd; ?>" data-toggle="modal"
                          edicao="<?= $edicao->edic_num.'ª '.$edicao->conf_abrev ?>">
                          <span class="glyphicon glyphicon-open-file"></span>&#09; Anais & Resultados</a>
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


<!-- Modal -->

  <div id="modalUploadAnaisResultados" class="modal fade">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title"><span class="fa fa-upload"></span></h4>
              </div>
              
                <div class="modal-body">
                  <div class="container-fluid">
                    
                    <br>
                    <fieldset class="col-md-12">     
                      <legend class="text-center">Anais</legend>
                      
                      <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <b><?php echo form_label( 'Upload de Anais de Evento', 'arquivo_anais' ); ?></b>
                                        <?php $data = array( 'name' => 'arquivo_anais', 'id' => 'arquivoAnais','type' => 'file',  
                                          'class' =>'file-uploading');
                                          echo form_upload($data);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      
                    </fieldset>
                  </div>
                  <div class="container-fluid">
                    <fieldset class="col-md-12">     
                      <legend class="text-center">Resultados</legend>
                      
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <b><?php echo form_label( 'Upload de Resultados', 'arquivo_resultados' ); ?></b>
                                        <?php $data = array( 'name' => 'arquivo_resultados', 'id' => 'arquivoResultados','type' => 'file',  
                                          'class' =>'file-uploading');
                                          echo form_upload($data);?>
                                    </div>
                                </div>
                            </div>
                      </div>
                     </div>
                      
                    </fieldset>
                  </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Concluído</button>
                </div>
          </div>
      </div>
  </div>

  <!-- PAGINAÇÃO -->
    <div class="text-center">
    Exibindo de 1 a <?php echo !empty($edicoes) ? sizeof($edicoes) : 0; ?> de um total de <?php echo !empty($edicoes) ? $totalRegistros : 0; ?> registros
    </div>
    <?php echo $paginacao; ?>
  <!--/ PAGINAÇÃO -->

</div>
