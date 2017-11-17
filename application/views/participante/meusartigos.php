<div class="container-fluid">
<h2><span class="fa fa-files-o"></span><b> Meus Trabalhos</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('artigo/consultar'); ?>" name="form-busca">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>" class="form-control estilo-botao-busca" 
               placeholder="Buscar por Título do Trabalho...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
    <div class="row">
        <div class="col-sm-12">

             <a class="btn btn-default margin-button" href='<?php echo site_url('/artigo/eventos-recentes'); ?>' style="float:right">
             <i class="glyphicon glyphicon-open-file" aria-hidden="true"></i> Submeter Novo Trabalho</a>

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
                            <th class="col-md-2 text-center">Evento</th>
                            <th class="col-md-4">Título</th>
                            <th class="col-md-2 text-center">Autor(es)</th>
                            <th><center>Situação</center></th>
                            <th class="col-md-2 text-center"> Opções </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($itens)){
                      foreach( $itens as $item ):?>
                          <tr>
                              <td class="text-center"><?= $item->edic_num.'ª '.$item->conf_abrev ?></td>
                              <td><?php echo $item->arti_title; ?></td>
                              <td class="text-center">
                              <?= somenteLetras($item->arti_autores); ?>

                              </td>
                              <td class="text-center"><?= $item->arti_status; ?></td>
                              <td class="text-left">


                                  <a href="<?= base_url('artigo/detalhes-do-trabalho/'.$item->arti_cd); ?>" class="btn-opcao">
                                  <span class="fa fa-eye"></span>&#09;Detalhar</a><br>

                                  <?php if($item->arti_status == 'Aprovado com ressalvas'){?>
                                        <a href="<?= base_url('submissao/cadastrar/'.$item->arti_cd); ?>" class="btn-opcao" >
                                        <span class="fa fa-plus"></span>&#09;Nova Submissão</a><br>
                                  <?php }?> 

                                  <?php if($item->arti_status == 'Pronto para a revisão'){?>      
                                  <a href="<?= base_url('artigo/alterar/'.$item->arti_cd); ?>" class="btn-opcao" >
                                  <span class="glyphicon glyphicon-open-file"></span>&#09;Editar Submissão</a><br>
                                  <?php } ?>


                                  <?php if($item->arti_status != 'Cancelado'){ ?>
                                  <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalCancelar"
                                     onclick="setCodigo('<?= $item->arti_cd; ?>'); 
                                    setLink('<?= base_url('artigo/cancelar/')?>')">
                                  <span class="fa fa-close"></span>&#09;Cancelar</a>
                                  <?php }?>


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
            <?= isset($paginacao) ? $paginacao : ''; ?>
          <!--/ PAGINAÇÃO -->
    </div>
</div>
<!-- Modal Cancelar Artigo -->
<div id="modalCancelar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Cancelar Revisão de Trabalho</h4>
            </div>
            <div class="modal-body">

                <p>Deseja realmente cancelar a revisão do seu trabalho?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button class="btn btn-success" onclick="Executa();">Continuar</button>
            </div>
        </div>
    </div>
</div>

</div>
