<div class="container-fluid">
    <h2> <span class="glyphicon glyphicon-list"> </span> <b> Minhas Atividades </b> </h2>
    <hr>
    <br>

    <div class="error"><?php echo validation_errors(); ?></div>
    <br>

    <?php
            $this->load->helper('html');
            echo alert($this->session);
    ?>
        <form method="GET" action="<?php echo base_url('atividade/consultarTudo'); ?>" name="form-busca">
            <div class="row">

                    <div class="col-sm-5">
                       <div class="input-group">
                             <input type="text" name="busca" id="busca" value="<?= isset($busca) ? $busca : ''?>" class="form-control estilo-botao-busca" 
                             placeholder="Buscar por título da atividade ou nome do participante...">
                             <span class="input-group-btn">
                                 <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                             </span>
                       </div><!-- /input-group -->
                     </div><!-- /.col-lg-6 -->
            </div><!-- /row -->
            <br><br>
            <div class="row">
                <div class="col-lg-2 col-lg-offset-10 
                     col-md-3 col-md-offset-9 
                     col-sm-4 col-sm-offset-8 
                     col-xs-6 col-xs-offset-6
                     form-group">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                            <p style="font-size: 13px; margin-top:10px">
                                <?php echo form_label( 'Registros:', 'limite'); ?>
                            </p>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <select name="limitereg" id="limitereg" class="selectComum form-control estilo-input" onchange="document.forms['form-busca'].submit();">
                                <option value="10" <?= $limiteReg == "10" ? 'selected' : ''?>>10</option>
                                <option value="25" <?= $limiteReg == "25" ? 'selected' : ''?>>25</option>
                                <option value="50" <?= $limiteReg == "50" ? 'selected' : ''?>>50</option>
                                <option value="100" <?= $limiteReg == "100" ? 'selected' : ''?>>100</option>
                                <option value="500"<?= $limiteReg == "500" ? 'selected' : ''?> >500</option>
                                <option value="0"<?= $limiteReg == "0" ? 'selected' : ''?> >Tudo</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<div class="row" id="ListagemRegistros">
    <div class="col-md-12" id="RegistrosPagina">
            <div class="table-responsive"><!-- TABELA-->
                <table class="table ls-table" id="tabela1">
                    <thead>
                        <tr>
                            <th>Participante Inscrito</th>
                            <th>Título da Atividade</th>
                            <th class="text-center">Evento</th>
                            <th class="text-center">Data</th>
                            <th class="text-center">Presença</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if(!empty($content)){
                                foreach( $content as $item ):
                                    $status = 1;
                         ?>

                                <tr>
                                    <td class="text-left"><?php echo $item->user_nm; ?></td>
                                    <td class="text-left"><?php echo $item->ativ_nm; ?></td>
                                    <td class="text-center"><?php echo $item->edic_num.'º '.$item->conf_abrev; ?></td>
                                    <td class="text-center col-sm-2"><?php echo date("d/m/Y", strtotime($item->ativ_dt)); ?></td>
                                    <td class="text-center"><?php echo $item->insc_status; ?></td>
                                </tr>
                        <?php endforeach; }else{ ?>
                          <tr>
                            <td class="col-xs-12 text-center" colspan="5">Não foram encontrados resultados para a sua busca...</td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /TABELA-->

            <!-- PAGINAÇÃO -->
                <div class="text-center">
                Exibindo de 1 a <?= !empty($content) ? sizeof($content) : 0; ?> de um total de <?= !empty($content) ? $totalRegistros : 0; ?> registros
                </div>
                <?= isset($paginacao) ? $paginacao : ''; ?>
              <!--/ PAGINAÇÃO -->
        </div>
    </div>
</div>

