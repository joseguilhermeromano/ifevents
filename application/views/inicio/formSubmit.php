

<section id="formSubmissao" style="">
            <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>Cadastro de Projetos</h3>
                                <hr class="star-primary">
                            </div>
                        </div>

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



            <?php 
                echo form_open_multipart( 'DataControl/submitCadastro', 'role="form" class="formsignin"' ); 

                echo form_fieldset( 'Enviar Artigo');    
                
                    echo form_label( 'Artigo', 'userfile' );
                    $data = array( 'name' => 'userfile' );
                    echo form_upload($data);                    

                    echo form_label( 'RA*', 'ra' );
                    $data = array('name' => 'ra', 'placeholder' => 'Registro Acadêmico' );
                    echo form_input($data);

                    echo form_label( 'Título*', 'titulo' );
                    $data = array( 'name' => 'titulo', 'placeholder' => "Título" );
                    echo form_input($data);

                    echo form_label( 'Autor*', 'autor' );
                    $data = array( 'name' => 'autor', 'placeholder' => 'Autor(es)' );
                    echo form_input($data);

                    echo form_label( 'Instituição*', 'instituicao' );
                    $data = array( 'name' => 'instituicao', 'placeholder' => 'Instituicao' );
                    echo form_input( $data );

                    echo form_label( 'Resumo*', 'resumo' );
                    $data = array( 'name' => 'resumo', 'placeholder' => 'Resumo' );
                    echo form_input( $data );

                    echo form_label( 'Área*', 'area' ).'<br>';
                        $opcoes = array(
                            'Ciência, Educação, Inovação'  => 'Ciência, Educação, Inovação',
                            'Práticas Sustentáveis'        => 'Práticas Sustentáveis',
                            'Ciência Alimentando o Brasil' => 'Ciência Alimentando o Brasil',                            
                            );
                    echo form_dropdown( 'area', $opcoes, 'Selecione uma Área' ).'<br>';
                        
                    echo '<br>';
                    echo form_label( 'Orientador*', 'orientador' );
                    $data = array( 'name' => 'orientador', 'placeholder' => 'Orientador' );
                    echo form_input( $data );        

                    echo form_label( 'Apoio', 'apoio' );
                    $data = array( 'name' => 'apoio', 'placeholder' => 'Apoio Financeiro' );
                    echo form_input( $data );

                    echo '<br><br>'.form_submit("btn_cadastro", "Cadastrar");

                echo form_fieldset_close();
                    
                    echo form_close();
            ?><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            
    </section>