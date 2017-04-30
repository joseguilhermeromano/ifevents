<div class="container-fluid">
<h2><span class="fa fa-files-o"></span><b> Meus Trabalhos</b></h2>
<hr>
<br>
<?php 
        $this->load->helper('html');
        echo alert($this->session);
?>
<form method="GET" action="<?php echo base_url('artigo/consultar'); ?>">
  <div class="row">
      <div class="col-sm-5">
         <div class="input-group">
               <input type="text" name="busca" class="form-control estilo-botao-busca" 
               placeholder="Buscar por Título do Trabalho...">
               <span class="input-group-btn">
                   <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
               </span>
         </div><!-- /input-group -->
       </div><!-- /.col-lg-6 -->
  </div><!-- /row -->
</form>
<div class="row">
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/artigo/cadastrar'); ?>' style="float:right">
         <i class="fa fa-plus" aria-hidden="true"></i> Novo Trabalho</a>
    </div>
</div>
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th class="col-md-6">Título</th>
                    <th>Última Modificação</th>
                    <th><center>Situação</center></th>
                    <th class="text-center"> Opções </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($itens)){
              foreach( $itens as $item ):?>
                  <tr>

                      <td><?php echo $item->arti_titu; ?></td>
                      <td class="text-center">30/04/2017</td>
                      <td class="text-center"><?php echo ($item->arti_status==0 ? "Submissões Ativas" : "Aprovado"); ?></td>
                      <td class="text-center"></td>
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
      Exibindo de 1 a <?php echo !empty($itens) ? sizeof($itens) : 0; ?> de um total de <?php echo !empty($itens) ? $totalRegistros : 0; ?> registros
      <?php } ?>
    </div>
    <?php isset($paginacao) ? $paginacao : ''; ?>
  <!--/ PAGINAÇÃO -->
</div>
