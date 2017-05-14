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




</div>
