

<section id="formSubmissao" style="">
            <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>Cadastro de Projetos</h3>
                                <hr class="star-primary">
                            </div>
                        </div>

                        <div class="error"><?php echo validation_errors(); ?></div>

                <?php if($this->session->flashdata('success')==TRUE){ ?>                           
                    <div class="panel panel-heading alert-info" role="alert">
                        <?php echo $this->session->flashdata('success');?>
                    </div>
                    
                    <?php }else{ ?>
                        <div class="panel panel-heading alert-info" role="alert">
                        <?php echo $this->session->flashdata('error');?>
                    </div>
                        
                    <?php } ?>


            <?php 
                echo form_open_multipart( 'DataControl/submitCadastro', 'role="form" class="formsignin" enctype="multipart/form-data"' ); 

                echo form_fieldset( 'Enviar Artigo');    

                    echo form_label( 'Artigo', 'subm_artigo' );
                    $data = array( 'name' => 'subm_artigo' );
                    echo form_upload($data);

                    echo form_label( 'RA', 'subm_ra' );
                    $data = array('name' => 'subm_ra', 'placeholder' => 'Registro Acadêmico' );
                    echo form_input($data);

                    echo form_label( 'Título', 'subm_titulo' );
                    $data = array( 'name' => 'subm_titulo', 'placeholder' => "Título" );
                    echo form_input($data);

                    echo form_label( 'Autor', 'subm_autor' );
                    $data = array( 'name' => 'subm_autor', 'placeholder' => 'Autor(es)' );
                    echo form_input($data);

                    echo form_label( 'Instituição', 'subm_instituicao' );
                    $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'Instituicao' );
                    echo form_input( $data );

                    echo form_label( 'Resumo', 'subm_resumo' );
                    $data = array( 'name' => 'subm_resumo', 'placeholder' => 'Resumo' );
                    echo form_input( $data );

                    echo form_label( 'Área', 'subm_area' ).'<br>';
                        $opcoes = array(
                            'Ciência, Educação, Inovação'  => 'Ciência, Educação, Inovação',
                            'Práticas Sustentáveis'        => 'Práticas Sustentáveis',
                            'Ciência Alimentando o Brasil' => 'Ciência Alimentando o Brasil',                            
                            );
                    echo form_dropdown( 'subm_area', $opcoes, 'Selecione uma Área' ).'<br>';
                        
                    //echo form_input( $opcoes );    
                    echo '<br>';
                    echo form_label( 'Orientador', 'subm_orientador' );
                    $data = array( 'name' => 'subm_orientador', 'placeholder' => 'Orientador' );
                    echo form_input( $data );        

                    echo form_label( 'Apoio', 'subm_apoio' );
                    $data = array( 'name' => 'subm_apoio', 'placeholder' => 'Apoio Financeiro' );
                    echo form_input( $data );

                    echo '<br><br>'.form_submit("btn_cadastro", "Cadastrar");

                echo form_fieldset_close();
                    
                    echo form_close();
            ?>


                        

                    
            <?php /*echo form_open_multipart('DataControl/submitCadastro', 'role="form" class="formsignin" enctype="multipart/form-data"'); ?>
                        <!--<div class="row text">
                            <div class="col-lg-8 col-lg-offset-2">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <?php// $data = array('name' => 'subm_artigo', 'subm_artigo');?>
                                <?php// echo form_upload($data);?>
                                <input type="file" class="form-control" name="subm_artigo" placeholder="Escolha o Arquivo" autofocus>
                                </br>
                            </div>
                        </div>   
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
                        <div>-->
                            <?php echo "<br>".form_submit('submit', 'Cadastrar', 'class="btn btnlg btn-primary btn-block"');*/?><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            
    </section>