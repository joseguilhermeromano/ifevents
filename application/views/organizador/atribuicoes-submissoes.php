<div class="container-fluid">
<h2><span class="fa fa-list"></span><b> Atribuição de Submissões</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="POST" id="form_atribuicoes" action="<?php echo base_url('artigo/listar-atribuicoes'); ?>">
<div class="row">
<div class="col-md-6">
<div class="row">
    <div class="col-sm-12">
         <button type="submit" class="btn btn-default margin-button" style="float:left">
         <i class="fa fa-user-plus" aria-hidden="true"></i> Atribuir Revisor</button>
    </div>
</div><br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    <th></th>
                    <th class="col-xs-8">Trabalho</th>
                    <th class="text-center" style="width:auto">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            //if(!empty($modalidades)){
            //foreach( $modalidades as $modalidade ): ?>
                <tr> 
                    <td class="text-center">
                        <input type="checkbox">
                    </td>
                    <td class="text-center"></td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href=" //base_url('modalidade/alterar/'.$modalidade->mote_cd); ?>" class="btn-opcao">
                          <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                    </div>
                    </td>
                </tr>
                <tr> 
                    <td class="text-center">
                        <input type="checkbox">
                    </td>
                    <td class="text-center"></td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href=" //base_url('modalidade/alterar/'.$modalidade->mote_cd); ?>" class="btn-opcao">
                          <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                    </div>
                    </td>
                </tr>
            <?php //endforeach;}else{ ?>
              <tr>
                <td class="col-xs-12 text-center" colspan="3">Não foram encontrados resultados para a sua busca...</td>
              </tr>
            <?php //} ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->
    <div class="text-center">
    Exibindo de 1 a <?php echo !empty($modalidades) ? sizeof($modalidades) : 0; ?> de um total de <?php echo !empty($modalidades) ? $totalRegistros : 0; ?> registros
    </div>
</div>
<div class="col-md-6">

  <div class="row">
      <div class="col-sm-8">
         <div class="input-group">
               <input type="text" name="buscaNomeRevisor" class="form-control estilo-botao-busca" 
               placeholder="Buscar por Nome de Revisor...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    <th></th>
                    <th class="col-xs-6">Revisor</th>
                    <th>Atribuições</th>
                    <th class="text-center" style="width:auto">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            //if(!empty($modalidades)){
            //foreach( $modalidades as $modalidade ): ?>
                 <tr> 
                    <td class="text-center">
                        <input type="checkbox" class="limited">
                    </td>
                    <td>José Guilherme Romano</td>
                    <td class="text-center">1/5</td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href=" //base_url('modalidade/alterar/'.$modalidade->mote_cd); ?>" class="btn-opcao">
                          <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                    </div>
                    </td>
                </tr>
                <tr> 
                    <td class="text-center">
                        <input type="checkbox" class="limited">
                    </td>
                    <td>José Guilherme Romano</td>
                    <td class="text-center">1/5</td>
                    <td class="text-center">
                    <div class="text-left" style="display: inline-block">
                          <a href=" //base_url('modalidade/alterar/'.$modalidade->mote_cd); ?>" class="btn-opcao">
                          <span class="fa fa-eye"></span>&#09;Detalhar</a><br>
                    </div>
                    </td>
                </tr>
            <?php //endforeach;}else{ ?>
              <tr>
                <td class="col-xs-12 text-center" colspan="4">Não foram encontrados resultados para a sua busca...</td>
              </tr>
            <?php //} ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->
    <div class="text-center">
    Exibindo de 1 a <?php echo !empty($modalidades) ? sizeof($modalidades) : 0; ?> de um total de <?php echo !empty($modalidades) ? $totalRegistros : 0; ?> registros
    </div>
</div>
</div>
</form>

</div>
