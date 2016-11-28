<h2><span class="glyphicon glyphicon-list"></span><b> Meus Artigos</b></h2>
<hr>
<br>
<div class="row">
    <div class="col-sm-6">
        <a href='<?php echo site_url('/participante/cadastraartigo'); ?>' class="btn btn-default visible-xs"><span class="glyphicon glyphicon-plus"></span> Novo Artigo</a><br>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6">
       <div class="input-group">
         <input type="text" class="form-control estilo-botao-busca" placeholder="Buscar por Título...">
         <span class="input-group-btn">
             <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
         </span>
       </div><!-- /input-group -->
     </div><!-- /.col-lg-6 -->
    <div class="col-md-6 col-sm-6">
         <a class="btn btn-default hidden-xs" href='<?php echo site_url('/participante/cadastraartigo'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Novo Artigo</a>
    </div>
</div><!-- /row -->
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th class="col-md-6">Título</th>
                    <th><center>Status</center></th>
                    <th><center>Histórico</center></th>
                    <th><center>Edição</center></th>
                    <th><center>Exclusão</center></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $itens as $item ):?>
                <tr>

                    <td><?php echo $item->arti_titu; ?></td>
                    <td class="text-center"><?php echo ($item->arti_status==0 ? "Submissões Ativas" : "Aprovado"); ?></td>
                    <td class="text-center">
                        <a href="<?php echo site_url('/participante/historicosubmissao?codigo='.$item->arti_id); ?>">
                            <span class="glyphicon glyphicon-folder-open estilo-botao-edicao"></span></a>
                    </td>
                    <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a></td>
                    <td class="text-center"><a href="#"><span class="glyphicon glyphicon-trash estilo-botao-exclusao"></span></a></td>

                </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
</div><!-- /TABELA-->
<nav><!-- Paginação -->
    <ul class="pagination">
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
