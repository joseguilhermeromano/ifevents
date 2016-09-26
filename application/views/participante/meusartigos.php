<h2><span class="glyphicon glyphicon-list"></span><b> Meus Artigos</b></h2>
<hr>
<br>
<div class="row">
    <div class="col-sm-6">
        <a class="btn btn-default visible-xs"><span class="glyphicon glyphicon-plus"></span> Nova Submissão</a><br>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6">
       <div class="input-group">
         <span class="input-group-btn">
             <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
         </span>
         <input type="text" class="form-control estilo-botao-busca" placeholder="Buscar por Título...">
       </div><!-- /input-group -->
     </div><!-- /.col-lg-6 -->
    <div class="col-md-6 col-sm-6">
         <a class="btn btn-default hidden-xs" href='<?php echo site_url('/participante/novoartigo'); ?>' style="float:right"><span class="glyphicon glyphicon-plus"></span> Nova Submissão</a>
    </div>
</div><!-- /row -->
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th>Título</th>
                    <th><center>Status</center></th>
                    <th><center>Edição</center></th>
                    <th><center>Exclusão</center></th>
            </tr>
        </thead>
        <tbody>
            <tr class="primeira-cor">
                    
                    <td><a href="" title=""><span class="glyphicon glyphicon-download"></span> - Titulo como link de downlod do artigo</a></td>
                    <td class="text-center">Submetido</td>
                    <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a></td>
                    <td class="text-center"><a href="#"><span class="glyphicon glyphicon-trash estilo-botao-exclusao"></span></a></td>
                    
            </tr>
            <tr  class="segunda-cor">
                    
                    <td><a href="" title=""><span class="glyphicon glyphicon-download"></span> - Titulo como link de downlod do artigo</a></td>
                    <td class="text-center">Submetido</td>
                    <td class="text-center"><a href="#"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a></td>
                    <td class="text-center"><a href="#"><span class="glyphicon glyphicon-trash estilo-botao-exclusao"></span></a></td>
                    
            </tr>
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
