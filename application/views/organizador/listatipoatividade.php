<h2> <span class="glyphicon glyphicon-blackboard"> </span> <b> Tipo de Atividades </b> </h2>
<hr>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>

<span id='topo'></span>

<div class="row">
    <div class="col-md-6 col-sm-6">
       <div class="input-group">
         <input type="text" class="form-control estilo-botao-busca" placeholder="Buscar por Título...">
         <span class="input-group-btn">
             <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
         </span>
       </div><!-- /input-group -->
     </div><!-- /.col-lg-6 -->
</div><!-- /row -->
<div class="row">
    <br>
    <div class="col-sm-12">
         <a class="btn btn-default margin-button" href='<?php echo site_url('/tipoatividade/cadastrar'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Novo Tipo Atividade</a>
         <a class="btn btn-default margin-button" href='<?php echo site_url('/atividade/consultarTudo'); ?>' style="float:left"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a>
    </div>
</div>

<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                <th><center>Título</center></th>
                <th><center>Descrição</center></th>
                <th><center>Excluir</center></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($atividade)):
                    foreach( $atividade as $item ):?>
                    <tr>
                        <td><?php echo $item->tiat_nm; ?></td>
                        <td class="text-center"><?php echo $item->tiat_desc; ?></td>
                        <td <div class="text-center" style="display: inline-block">
                        		<a class="btn-opcao" href="<?php echo base_url('/tipoatividade/alterar/'.$item->tiat_cd);  ?>">
                            		<span class="glyphicon glyphicon-pencil"></span>&#09;Editar
								</a><br>
                                <a href="#" class="btn-opcao" data-toggle="modal" data-target="#modalExcluir"
									onclick="setCodigo('<?php echo $item->tiat_cd; ?>');
									setLink('<?php echo base_url('/tipoatividade/excluir/')?>');">
									<span class="glyphicon glyphicon-remove"></span>&#09;Excluir
								</a>
                            </div>
                        </td>
                    </tr>
            <?php endforeach;
            endif;?>
        </tbody>
    </table>
</div><!-- /TABELA-->
<nav><!-- Paginação -->
    <ul class="pagination" text-align="center">
      <li>
        <a href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li>
        <a href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
</nav><!-- /Paginação -->

<a class="btn btn-default margin-button" href="#topo" style="float:left"><span class="glyphicon glyphicon-arrow-up"></span></a>
