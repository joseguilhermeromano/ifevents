<h2> <span class="glyphicon glyphicon-blackboard"> </span> <b> Meus Eventos </b> </h2>
<hr><br>
<div class="error"><?php echo validation_errors(); ?></div>
<br>
<?php
     if(!empty($inscrito)):
?>
<div class="table-responsive">
    <table class="table ls-table" id="tabela1">
        <thead>
            <tr>
                <th><center>Título</center></th>
                <th><center>Descrição</center></th>
                <th><center>Data  </center></th>
                <th><center>Inicio</center></th>
                <th><center>Término</center></th>
                <th><center>Local</center></th>
            </tr>
        </thead>
<?php else: ?>
    <div class="alert alert-info" role="alert">
         <h1>Você não está cadastrado em nenhum evento</h1>
    </div>
<?php endif;?>
        <tbody>

        <?php if(!empty($content)):
                foreach( $content as $item ):
                    if(!empty($inscrito)):
                        foreach ($inscrito as $value):
                            if($value->insc_user_cd == $this->session->userdata('usuario')->user_cd &&
                               $value->insc_ativ_cd == $item->ativ_cd): ?>
                                <tr>
                                    <td><?php echo $item->ativ_nm; ?></td>
                                    <td class="text-center"><?php echo $item->ativ_desc; ?></td>
                                    <td class="text-center"><?php echo date("d/m/Y", strtotime($item->ativ_dt)); ?></td>
                                    <td class="text-center"><?php echo date("H:i", strtotime($item->ativ_hora_ini)); ?></td>
                                    <td class="text-center"><?php echo date("H:i", strtotime($item->ativ_hora_fin)); ?></td>
                                    <td class="text-center"><?php echo $item->ativ_local; ?></td>
                                </tr>

                      <?php endif;
                        endforeach;
                    endif;?>
         <?php  endforeach;
            endif;?>
        </tbody>
    </table>
</div>
