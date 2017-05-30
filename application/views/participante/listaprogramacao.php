<h2> <span class="glyphicon glyphicon-blackboard"> </span> <b> Atividades </b> </h2>
<hr>
<br>

<div class="error"><?php echo validation_errors(); ?></div>
<br>

<?php
        $this->load->helper('html');
        echo alert($this->session);
?>

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
                <th><center>Título</center></th>
                <th><center>Descrição</center></th>
                <th><center>Data  </center></th>
                <th><center>Inicio</center></th>
                <th><center>Término</center></th>
                <th><center>Local</center></th>
                <th><center>Vagas</center></th>
                <th><center>Incrição</center></th>
                <th><center>Cancelar</center></th>

            </tr>
        </thead>
        <tbody>
            <?php

                if(!empty($content)):
                    foreach( $content as $item ):
                        $status = 1;
             ?>

                    <tr>
                        <td><?php echo $item->ativ_nm; ?></td>
                        <td class="text-center"><?php echo $item->ativ_desc; ?></td>
                        <td class="text-center"><?php echo date("d/m/Y", strtotime($item->ativ_dt)); ?></td>
                        <td class="text-center"><?php echo date("H:i", strtotime($item->ativ_hora_ini)); ?></td>
                        <td class="text-center"><?php echo date("H:i", strtotime($item->ativ_hora_fin)); ?></td>
                        <td class="text-center"><?php echo $item->ativ_local; ?></td>
                        <td class="text-center"><?php echo $item->ativ_vagas_qtd; ?></td>
                        <td class="text-center"><a href="<?php echo base_url('/inscricao/inscricao/'.$item->ativ_cd.'/'.$status); ?>"><span class="glyphicon glyphicon-edit estilo-botao-edicao"></span></a></td>
                        <td class="text-center"><a href="<?php echo base_url('/inscricao/excluir/'.$item->ativ_cd); ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
            <?php endforeach;
                  endif;?>
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
