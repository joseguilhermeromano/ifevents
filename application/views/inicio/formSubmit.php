

<section id="formSubmissao" style="display: ;">
            <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>Cadastro de Projetos</h3>
                                <hr class="star-primary">
                            </div>
                        </div>

                        <div class="error"><?php echo validation_errors(); ?></div>

                <?php $msg1 = $this->session->flashdata('submited');            
                 if (isset($msg1) && $msg1!=''){?>
                    <div class="panel panel-heading alert-info" role="alert">
                        <?php echo $msg1;?>
                    </div>
                <?php }?>


            <?php echo form_open_multipart('DataControl/submitCadastro', 'role="form" class="formsignin" enctype="multipart/form-data"'); ?>
                        <div class="row text">
                            <div class="col-lg-8 col-lg-offset-2">
                       <!-- <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="file" class="form-control" name="subm_article" placeholder="Escolha o Arquivo" autofocus>
                                </br>
                            </div>
                        </div>-->   
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="subm_ra" placeholder="Registro Acadêmico" autofocus>
                                </br>
                            </div>
                        </div>
                         <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="subm_titulo" placeholder="Título" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="subm_autor" placeholder="Autor(es)" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="subm_instituicao" placeholder="Instituição" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="subm_resumo" placeholder="Resumo" autofocus>
                                </br>
                            </div>
                        </div>                       

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <div class="styled-select">                        	                          	
                                    <select class="form-control" name="subm_area">
                                        <option value="">Selecione a Área</option> 
                                        <option value="Automação">Automação Indústrial</option>
                                        <option value="ADS">Análise e Desenvolvimento de Sistemas</option>
                                        <option value="Matemática">Matemática</option>
                                        <option value="Engenharia">Engenharia de Software</option>         
                                    </br>
                                    </select>
                                </div>
                            </div>
                        </div>	


                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="subm_orienta" placeholder="Orientador" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="subm_apoio" placeholder="Apoio Financeiro" autofocus>
                                </br>
                            </div>
                        </div>
                                                
                        <br>
                        <div>
                            <?php echo "<br>".form_submit('submit', 'Cadastrar', 'class="btn btnlg btn-primary btn-block"');?><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            
    </section>

         
<?php echo "nao funciona";?>