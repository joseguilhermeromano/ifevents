                
<div class="error"><?php echo validation_errors(); ?></div>

<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success"> 
        <?= $this->session->flashdata('success') ?> 
    </div>
<?php } ?>

<?php if ($this->session->flashdata('empty')) { ?>
    <div class="alert alert-danger"> 
        <?= $this->session->flashdata('empty') ?> 
    </div>
<?php } ?>

<?php if ($this->session->flashdata('fail')) { ?>
    <div class="alert alert-danger"> 
        <?= $this->session->flashdata('fail') ?> 
    </div>
<?php } ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Cadastros</h2>
                <hr class="star-primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                       
            <p>
                Para participar como expositor de algum projeto, ou comunicador, preencha o formulário de Cadastro de Participantes.
            </p>
                <button class="btn btn-warning" onclick="aparece('formularioParticipante');">Cadastro de Participantes</button>
                <br><br><br><br><br>
            </div>
                            
            <div class="col-lg-12 text-center">
                <p>
                    Para participar como avaliador dos projetos, preencha o formulário de Cadastro de Avaliadores.
                </p>
                    <button class="btn btn-warning" onclick="aparece('formularioAvaliador');">Cadastro de Avaliadores</button>
                    <br><br><br><br><br><br><br>
                </div>
            </div>
        

        <section id="formularioParticipante" style="display: none;">
            <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>Cadastro de Participantes</h3>
                                <hr class="star-primary">
                            </div>
                        </div>
            <?php echo form_open('InicioControl/cadastraUser', 'role="form" class="formsignin"'); ?>
                        <div class="row text">
                            <div class="col-lg-8 col-lg-offset-2">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="nome" placeholder="Nome Completos" autofocus>
                                </br>
                            </div>
                        </div>
                       
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="instituicao" placeholder="Instituição/Empresa" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="fone" placeholder="Telefone" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="email" placeholder="Email" autofocus>                              
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="password" class="form-control" name="senha" placeholder="Senha" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="hidden" class="form-control" name="tipo" value="<?php  $tipo = 0; ?>" placeholder="Tipo de Usuário" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="valida" placeholder="Valida Email" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="status" placeholder="Status" autofocus>
                                </br>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-12 text-center">
                            <?php echo "<br>".form_submit('submit', 'Cadastrar', 'class="btn btnlg btn-primary"');?><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
    </section>
    <section id="formularioAvaliador" style="display: none;">
            <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>Cadastro de Avaliadores</h3>
                                <hr class="star-primary">
                            </div>
                        </div>
            <?php echo form_open('InicioControl/submitCadastro', 'role="form" class="formsignin"'); ?>
                        <div class="row text">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="nome" placeholder="Nome Completo" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="cpf" placeholder="CPF" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="rg" placeholder="RG" autofocus>
								</br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="titulacao" placeholder="Titulação" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="rg" placeholder="Área de Intersse" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="graduacao" placeholder="Graduação" autofocus>
								</br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="inst_empresa" placeholder="Instituição/Empresa" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	 <input type="text" class="form-control" name="phone" placeholder="Telefone" autofocus>
                                 </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="celular" placeholder="Celular" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="email" class="form-control" name="email" placeholder="Email" autofocus>                              
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	 <input type="password" class="form-control" name="senha" placeholder="Senha" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	 <input type="text" class="form-control" name="email" placeholder="RA" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <?php echo "<br>".form_submit('submit', 'Cadastrar', 'class="btn btnlg btn-primary"');?><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>    

        </section>
    </div>
    </div>