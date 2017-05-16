<div class="container-fluid">
<h2><span class="fa fa-file-text-o"></span><b> Detalhes do Trabalho</b></h2>
<hr>
<br>
<div class="row">
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading hidden-xs" id="header_1" >
            <b>Detalhes do Trabalho</b>
        </div>
        <div class="panel-body" id="Painel_1">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                            <th colspan="2" class="text-center">Informações Gerais</th>
                        </thead>
                        <tbody>
                             
                            <tr>
                                <th class="col-xs-4">Título</th>
                                <td><?=  $artigo->arti_title; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Orientador</th>
                                <td><?= $artigo->arti_orienta; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Autores</th>
                                <td><?= $artigo->arti_autores; ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Eixo Temático</th>
                                <td><?= $artigo->eixo ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Modalidade</th>
                                <td><?= $artigo->modalidade ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Situação</th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <thead>
                            <th colspan="1" class="text-center">Resumo</th>
                        </thead>
                        <tbody>
                                <tr>
                                    <td><?= $artigo->arti_resumo; ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach($submissoes as $key => $submissao): ?>

<div class="col-md-6">
    <div class="panel panel-success">
        <!-- Versão para Celular-->
        <div class="panel-heading" id="header_2" 
             onclick="javascript: MostrarEsconderPainel('#Painel_2','#header_2');">
            <b><span class="glyphicon glyphicon-triangle-right"></span> Submissão: <?= $submissao->subm_versao; ?>ª Versão</b>
        </div>
        <div class="panel-body" id="Painel_2" style="display:none">
            <table class="table">
                <thead>
                    <th colspan="2" class="text-center">Informações da Submissão</th>
                </thead>
                <tbody>
                    <tr>
                        <th class="col-xs-2">Data/Hora</th>
                        <td><?= desconverteDataMysql($submissao->subm_dt); ?> às <?= date('H:i',(int) $submissao->subm_hr); ?> </td>
                    </tr>
                    <tr>
                        <th class="col-xs-2">Arquivo sem identificação</th>
                        <td><a href="<?= base_url('artigo/download/1/'.$submissao->subm_cd); ?>" class="btn-opcao">
                        <span class="glyphicon glyphicon-save-file"></span> <?= $submissao->subm_arq1_nm; ?></a></td>
                    </tr>
                    <tr>
                        <th class="col-xs-2">Arquivo com identificação</th>
                        <td>
                        <?php if (!empty($submissao->subm_arq2_nm)){?>
                        <br><a href="<?= base_url('artigo/download/2/'.$submissao->subm_cd); ?>" class="btn-opcao">
                        <span class="glyphicon glyphicon-save-file"></span> <?= $submissao->subm_arq2_nm; ?></a></td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>

            <div class="panel panel-danger">
                <!-- Versão para Celular-->
                <div class="panel-heading" id="header_3" 
                     onclick="javascript: MostrarEsconderPainel('#Painel_3','#header_3 b');">
                    <b><span class="glyphicon glyphicon-triangle-right"></span> Revisões</b> 
                </div>
              <div class="panel-body" id="Painel_3" style="display:none">
                    <table class="table">
                        <thead>
                            <th colspan="2" class="text-center">Versão da submissão Avaliada: </th>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="col-xs-3">Data</th>
                                <td>07/10/206</td>
                            </tr>
                            <tr>
                                <th class="col-xs-3">Resultado</th>
                                <td>Aceito com solicitação de alterações</td>
                            </tr>
                            <tr>
                                <th class="col-xs-3">Parecer do Revisor</th>
                                <td>Parabéns, você realizou um ótimo trabalho!</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
            
      </div>
    </div>
</div>

<?php endforeach; ?>
   
</div>
<a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>
</div>

