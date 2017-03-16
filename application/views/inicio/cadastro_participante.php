<div id="cadastro" class="section">         
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="estilo-h1">Cadastro de Participantes</h1>
                <br>

                    <?php
                        if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"> 
                            <?= $this->session->flashdata('error') ?> 
                        </div>
                    <?php } ?>
                    <?php
                    if(!empty(validation_errors())){
                        echo '<div class="alert alert-danger">'.validation_errors().'</div>';
                    }
                    ?>
                    <?php
                     if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success"> 
                            <?= $this->session->flashdata('success') ?> 
                        </div>
                    <?php
                     } 
                     ?>
            </div>
        </div>
         
         <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <p class="text-left">OBS: Caso você seja Revisor ou Organizador e deseja se cadastrar, envie uma mensagem de contato, para que seja possível receber o link de  cadastro!</p><br>
                <h3>Dados Pessoais</h3><br>
                <?php echo form_open('InicioControl/cadastraUser', 'role="form" class="formsignin"'); ?>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome Completo" autofocus>
                        </br>
                    </div>
                </div>
       
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="instituicao">Instituição</label>
                        <input type="text" class="form-control" name="instituicao" placeholder="Instituição/Empresa" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="telefone">Telefone</label>
                    	<input type="text" class="form-control" name="fone" placeholder="Telefone" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" name="email" placeholder="Email" autofocus>                              
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="confirmaemail">Confirma E-mail</label>
                        <input type="text" class="form-control" name="confirmaemail" placeholder="Confirma E-mail" autofocus>                              
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" placeholder="Senha" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="confirmasenha">Confirma Senha</label>
                        <input type="password" class="form-control" name="confirmasenha" placeholder="Confirma Senha" autofocus>
                        </br>
                    </div>
                </div>
                <br>
                <h3>Endereço</h3><br>
                <br>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" name="logradouro" placeholder="Logradouro" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" name="bairro" placeholder="Bairro" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" name="numero" placeholder="Número" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" name="complemento" placeholder="Complemento" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="cep">Cep</label>
                        <input type="text" class="form-control" name="cep" placeholder="Cep" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" name="cidade" placeholder="Cidade" autofocus>
                        </br>
                    </div>
                </div>
                <div class="row control-group">
                    <div class="form-group col-xs-12 floating-label-form-group controls">
                        <label for="uf" class="col-lg-2 control-label">UF</label>
                          <select class="form-control" id="uf">
                            <option>AC</option>
                            <option>AL</option>
                            <option>AM</option>
                            <option>AP</option>
                            <option>BA</option>
                            <option>CE</option>
                            <option>DF</option>
                            <option>ES</option>
                            <option>GO</option>
                            <option>MA</option>
                            <option>MG</option>
                            <option>MS</option>
                            <option>MT</option>
                            <option>PA</option>
                            <option>PB</option>
                            <option>PE</option>
                            <option>PI</option>
                            <option>PR</option>
                            <option>RJ</option>
                            <option>RN</option>
                            <option>RO</option>
                            <option>RR</option>
                            <option>RS</option>
                            <option>SC</option>
                            <option>SE</option>
                            <option selected="selected">SP</option>
                            <option>TO</option>
                          </select>
                            </br>
                    </div>
                </div>
                <br>
                <div class="col-lg-12 text-center">
                    <?php echo "<br>".form_submit('submit', 'Cadastrar', 'class="btn btnlg btn-success"');?><br><br><br><br><br><br><br>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
