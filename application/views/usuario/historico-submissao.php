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
                                <td><?=  $artigo->getTitulo(); ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Orientador</th>
                                <td><?= $artigo->getOrientador(); ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Autores</th>
                                <td><?= somenteLetras(implode(', ',$artigo->getAutores())); ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Eixo Temático</th>
                                <td><?= $artigo->getEixoTematico()->mote_nm ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Modalidade</th>
                                <td><?= $artigo->getModalidade()->mote_nm ?></td>
                            </tr>
                            <tr>
                                <th class="col-xs-4">Situação</th>
                                <td><?= $artigo->getStatus() ?></td>
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
                                    <td><?= $artigo->getResumo(); ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
<?php 
$count = 0;
foreach($submissoes as $key => $submissao): 
$count++;
$painel = "painel_subm_".$count;
$header = "header_subm_".$count;
$numeroColunas = 2;
$linhas = 0;

?>

<div class="col-md-6">
    <div class="panel panel-success">
        <!-- Versão para Celular-->
        <div class="panel-heading" id="<?= $header ?>" 
             onclick="javascript: MostrarEsconderPainel('#<?= $painel ?>','#<?= $header ?>');">
            <b><span class="glyphicon glyphicon-triangle-right"></span> Submissão: <?= $submissao->getVersao(); ?> ª Versão</b>
        </div>
        <div class="panel-body" id="<?= $painel ?>" style="display:none">
            <table class="table">
                <thead>
                    <th colspan="2" class="text-center">Informações da Submissão</th>
                </thead>
                <tbody>
                    <tr>
                        <th class="col-xs-2">Data/Hora</th>
                        <td><?= desconverteDataMysql($submissao->getData()); ?> às <?= date('H:i',(int) $submissao->getHora()); ?> </td>
                    </tr>
                    <tr>
                        <th class="col-xs-2">Arquivo sem identificação</th>
                        <td><a href="<?= base_url('submissao/download-artigo/'
                        . 'sem-identificacao/'.$submissao->getCodigo()); ?>" class="btn-opcao">
                        <span class="glyphicon glyphicon-save-file"></span> <?= $submissao->getNomeArqSemIdent(); ?></a></td>
                    </tr>
                    <?php if($this->session->userdata("usuario")->user_tipo != 2 ){ ?>
                    <tr>
                        <th class="col-xs-2">Arquivo com identificação</th>
                        <td>
                        
                        <br><a href="<?= base_url('submissao/download-artigo/'
                        . 'com-identificacao/'.$submissao->getCodigo()); ?>" class="btn-opcao">
                        <span class="glyphicon glyphicon-save-file"></span> <?= $submissao->getNomeArqComIdent(); ?></a></td>
                        
                    </tr>
                    <?php } ?>
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

<?php 
    $linhas++;
    if($linhas % $numeroColunas == 0){ 
        echo '</div><div class="row">';
    }
    endforeach; ?>
</div>
</div>
<a href='javascript: window.history.back();' class='btn btn-default button'>Voltar</a>
</div>

