<h2><span class="glyphicon glyphicon-home"></span><b> Início</b></h2>
<hr>
<br>
<div class="mensagem-entrada">Olá, Sr(a) Organizador(a) <b><?= $this->session->userdata('usuario')->user_nm; ?></b>! Seja bem vindo à plataforma <b>IFEVENTS!</b></div><br>

<h3><span class="glyphicon glyphicon-alert"></span><b> Indicadores de Desempenho</b></h3>
<br>
 <div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-envelope fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($novasMensagens) ? $novasMensagens : 0?></div>
                        <div class="font-panel"><b>Novas Mensagens!</b></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('contato/consultarTudo') ;?>">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-open-file fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($novasSubmissoes) ? $novasSubmissoes : 0?></div>
                        <div class="font-panel"><b>Novas Submissões!</b></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('revisao/consultar-atribuicoes'); ?>">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-exclamation-triangle fa-4x"></i>
                    </div>
                    <div class="col-xs-10 text-right">
                        <div class="huge"><?= isset($trabalhosNaoAvaliados) ? $trabalhosNaoAvaliados : 0?></div>
                        <div class="font-panel"><b>Trabalhos não avaliados!</b></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('revisao/consultar-resultados'); ?>">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-ok fa-4x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($trabalhosAvaliados) ? $trabalhosAvaliados : 0?></div>
                        <div class="font-panel"><b>Trabalhos Avaliados!</b></div>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('artigo/resultados-finais'); ?>">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<h4><span class="glyphicon glyphicon-calendar"></span><b> Datas importantes</b></h4>
<br>
<div class="row">
      <div class="col-sm-12">
        <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioSubmissao()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimSubmissao()); ?> </h1>
                    <h2>Inscrições para Submissão de Trabalhos</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioPublicacao()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimPublicacao()); ?> </h1>
                    <h2>Publicação dos trabalhos aceitos</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioEvento()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimEvento()); ?> </h1>
                    <h2>Realização da Semana</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>De <?= desconverteDataMysql($evento->getDataInicioInscricao()); ?>
                    Até <?= desconverteDataMysql($evento->getDataFimInscricao()); ?> </h1>
                    <h2>Período de inscrição para as atividades do evento</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 center-xs">
            <div class="postit">
                <i class="pin"></i>
                <div class="postit-conteudo">
                    <h1>Dia  <?= desconverteDataMysql($evento->getDataFimEvento()); ?></h1>
                    <h2>Encerramento e Cerimônia de premiação</h2>
                </div>
            </div>
        </div>
      </div>
    </div>
    </div>
<br><br>


