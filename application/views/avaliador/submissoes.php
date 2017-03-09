<h2><span class="glyphicon glyphicon-list"></span><b> Submissões Ativas</b></h2>
<hr>

<br>
<div class="row">
    <div class="col-md-6 col-sm-6">
       <div class="input-group">
<?php       
        //if(empty($result) != False){?>
<!--          <div class="alert alert-danger"> 
              <h1>Não Existem submissões ativas!!!</h1>
          </div>-->
  <?php //} 
 //       else{?>       
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
                    <th><center>Conferência</center></th>
                    <th><center>Eixo Temático</center></th>
                    <th><center>Situação</center></th>
                    <th><center>Visualiar Histórico</center></th>
            </tr>
        </thead>
        <tbody>
        
        <?php 
            
//            $i = 2;
//            $cor='';
//           foreach( $result as $itens ):
//               
//                if($i % 2 == 0){
//                  $cor='primeira-cor';  
//                }else{
//                  $cor='segunda-cor'; 
//                }
          
        ?>
            <tr class="<?php //echo $cor; ?>">    
                  <td><?php  //echo $itens->arti_titul;?></td>
                  <td class="text-center">FLISOLI2016</td>
                  <td class="text-center"><?php //echo $itens->arti_are;?></td>
                  <td class="text-center">Não Avaliado</td>
                  <td class="text-center"><?php  echo anchor('AvaliadorControl/historicoSubmissao/','<span class="glyphicon glyphicon-eye-open estilo-botao-edicao"></span>'); ?></td>                 
            </tr>
            <?php  
//                $i++;
//                endforeach; ?> 
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
    <?php  
        //}
        ?> 
</nav><!-- /Paginação -->


