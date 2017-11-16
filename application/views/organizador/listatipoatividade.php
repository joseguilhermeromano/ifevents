<div class="container-fluid">
    <h2> <span class="glyphicon glyphicon-blackboard"> </span> <b> Tipo de Atividades </b> </h2>
    <hr>
    <br>
    <?php
      $this->load->helper('html');
      echo alert($this->session);
    ?>
    <span id='topo'></span>
    <form method="GET" action="<?php echo base_url('tipoatividade/consultarTudo'); ?>" name="form-busca">
        <div class="row">
            <div class="col-sm-4">
               <div class="input-group">
                     <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>" class="form-control estilo-botao-busca" 
                     placeholder="Buscar por Título...">
                     <span class="input-group-btn">
                         <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                     </span>
               </div><!-- /input-group -->
             </div><!-- /.col-lg-6 -->
        </div>
        <div class="row">
          <br>
          <div class="col-sm-12">
            <a class="btn btn-default margin-button" href='<?php echo site_url('/tipoatividade/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Novo Tipo Atividade</a>
            <a class="btn btn-default margin-button" href='<?php echo site_url('/atividade/consultarTudo'); ?>' style="float:left"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
          </div>
        </div>
        <br><br>
        <div class="row">
            <div class="form-group col-md-3">
                <?php echo form_label( 'Número de Registros:', 'limite'); ?>
                <select name="limitereg" id="limitereg" class="selectComum form-control" onchange="document.forms['form-busca'].submit();">
                    <option value="10" <?= $limiteReg == "10" ? 'selected' : ''?>>10</option>
                    <option value="25" <?= $limiteReg == "25" ? 'selected' : ''?>>25</option>
                    <option value="50" <?= $limiteReg == "50" ? 'selected' : ''?>>50</option>
                    <option value="100" <?= $limiteReg == "100" ? 'selected' : ''?>>100</option>
                    <option value="500"<?= $limiteReg == "500" ? 'selected' : ''?> >500</option>
                    <option value="0"<?= $limiteReg == "0" ? 'selected' : ''?> >Tudo</option>
                </select>
            </div>
        </div>
    </form><br>
    
    <div class="row" id="ListagemRegistros">
        <div class="col-md-12" id="RegistrosPagina">
            <div class="table-responsive">
              <table class="table ls-table" id="tabela1">
                <thead>
                  <tr>
                    <th><center>Título</center></th>
                    <th>Descrição</th>
                    <th><center>Opções</center></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  if(!empty($atividade)){
                    foreach( $atividade as $item ):?>
                    <tr>
                        <td><?php echo $item->tiat_nm; ?></td>
                        <td class="text-left"><?php echo $item->tiat_desc; ?></td>
                        <td class="text-center">
                            <div class="text-left" style="display: inline-block">
                                <a href="<?= base_url('tipoatividade/alterar/'.$item->tiat_cd); ?>" class="btn-opcao">
                                <span class="glyphicon glyphicon-pencil"></span>&#09;Ver/Editar</a><br>
                                <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
                                onclick="setCodigo('<?= $item->tiat_cd; ?>'); 
                                setLink('<?= base_url('tipoatividade/excluir/')?>');">
                                <span class="fa fa-trash"></span>&#09;Excluir</a>
                            </div>
                        </td>
                    </tr>
              <?php endforeach; }else{ ?>
                          <tr>
                            <td class="col-xs-12 text-center" colspan="3">Não foram encontrados resultados para a sua busca...</td>
                          </tr>
                        <?php } ?>
                </tbody>
              </table>
            </div>

            <!-- PAGINAÇÃO -->
                <div class="text-center">
                Exibindo de 1 a <?= !empty($atividade) ? sizeof($atividade) : 0; ?> de um total de <?= !empty($atividade) ? $totalRegistros : 0; ?> registros
                </div>
                <?= isset($paginacao) ? $paginacao : ''; ?>
              <!--/ PAGINAÇÃO -->
        </div>
    </div>
</div>