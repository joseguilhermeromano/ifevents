<h2><span class="glyphicon glyphicon-list"></span><b> Submissões Ativas</b></h2>
<hr>
<br>
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
<br><br>
<div class="table-responsive"><!-- TABELA-->
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                    
                    <th>Título</th>
                    <th><center>Edição/Conferência</center></th>
                    <th><center>Eixo Temático</center></th>
                    <th><center>Modalidade</center></th>
                    <th><center>Status</center></th>
            </tr>
        </thead>
        <tbody>
            <tr onclick="javascript: MostrarEsconderLinha('#linha1');">
                    
                    <td>Título como link de downlod do artigo</td>
                    <td class="text-center">5º SEMCITEC</td>
                    <td class="text-center">Ciência Alimentando o Brasil.</td>
                    <td class="text-center">Resumo</td>
                    <td class="text-center">Não Alocado</td>
                    
            </tr>
            <tr>
                <td colspan="5" class="well" id="linha1" style="display:none">
                        <div class="col-md-8">
                            <div class="page-header text-center" style="border-color: #CFCFCF; margin:0px;">
                                <h5><b>Resumo</b></h5>
                            </div>
                            <div class="container-fluid">
                                <br>teste<br>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="page-header text-center" style="border-color: #CFCFCF; margin:0px;">
                                <h5><b>Ações</b></h5>
                            </div>
                            <div class="container-fluid">
                                <br>
                                <a href="#">
                                    <span class="glyphicon glyphicon-arrow-down estilo-botao-submissao-ativa">
                                        Download do Trabalho
                                    </span>
                                </a><br>
                                <a href="#">
                                    <span class="glyphicon glyphicon-folder-open estilo-botao-submissao-ativa">
                                        Histórico da Submissão
                                    </span>
                                </a><br>
                                <a href="#">
                                    <span class="glyphicon glyphicon-user estilo-botao-submissao-ativa">
                                        Alocar Avaliador
                                    </span>
                                </a><br>
                                <a href="#">
                                    <span class="glyphicon glyphicon-ok-circle estilo-botao-submissao-ativa">
                                        Aceitar Trabalho
                                    </span>
                                </a><br>
                                <a href="#">
                                    <span class="glyphicon glyphicon-remove-circle estilo-botao-submissao-ativa">
                                        Recusar Trabalho
                                    </span>
                                </a><br>
                            </div>
                        </div>        
                </td>
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


