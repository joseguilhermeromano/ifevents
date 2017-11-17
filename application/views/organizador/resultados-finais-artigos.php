<div class="container-fluid">
<h2><span class="fa fa-clipboard"></span><b> Resultados Finais dos Trabalhos</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('artigo/resultados-finais'); ?>" name="form-busca">
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
                        <th class="col-xs-4">Título do Trabalho</th>
                        <th class="text-center col-xs-2">Modalidade</th>
                        <th class="text-center col-xs-2">Eixo Temático</th>
                        <th class="text-center col-xs-2">Situação</th>
                        <th class="text-center col-xs-2">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($itens)){
                    foreach( $itens as $resultado ): ?>
                         <tr> 
                            <td><?= $resultado->arti_title; ?></td>
                            <td class="text-center">
                                <?= $resultado->modalidade; ?>
                            </td>
                            <td class="text-center">
                                <?= $resultado->eixo; ?>
                            </td>
                            <td class="text-center">
                                <?= $resultado->arti_status; ?>
                            </td>
                            <td class="text-center">
                            <div class="text-left" style="display: inline-block">
                                <a href="<?= base_url('artigo/detalhes-do-trabalho/'.$resultado->arti_cd); ?>" class="btn-opcao">
                                <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
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
          <?php if(!empty($itens)): ?>
          <!-- PAGINAÇÃO -->
            <div class="text-center">
            Exibindo de 1 a <?php echo !empty($itens) ? sizeof($itens) : 0; ?> 
            de um total de <?php echo !empty($itens) ? $totalRegistros : 0; ?> registros
            </div>
            <?= isset($paginacao) ? $paginacao : ''; ?>
          <!--/ PAGINAÇÃO -->
          <?php endif; ?>
        </div>
    </div>
</div>
