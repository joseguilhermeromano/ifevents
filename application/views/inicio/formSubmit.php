

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
                echo form_open_multipart( 'DataControl/submitCadastro', 'role="form" class="formsignin" enctype="multipart/form-data"' ); 

                echo form_fieldset( 'Enviar Artigo');    
               
                    echo form_label( 'Artigo', 'subm_artigo' );
                    $data = array( 'name' => 'subm_artigo' );
                    echo form_upload($data);

                    echo form_label( 'RA*', 'subm_ra' );
                    $data = array('name' => 'subm_ra', 'id' => 'subm_ra', 'placeholder' => 'Registro Acadêmico' );
                    echo form_input($data);

                    echo form_label( 'Título*', 'subm_titulo' );
                    $data = array( 'name' => 'subm_titulo', 'placeholder' => "Título" );
                    echo form_input($data);

                    echo form_label( 'Autor*', 'subm_autor' );
                    $data = array( 'name' => 'subm_autor', 'placeholder' => 'Autor(es)' );
                    echo form_input($data);

                    echo form_label( 'Instituição*', 'subm_instituicao' );
                    $data = array( 'name' => 'subm_instituicao', 'placeholder' => 'Instituicao' );
                    echo form_input( $data );

                    echo form_label( 'Resumo*', 'subm_resumo' );
                    $data = array( 'name' => 'subm_resumo', 'placeholder' => 'Resumo' );
                    echo form_input( $data );

                    echo form_label( 'Área*', 'subm_area' ).'<br>';
                        $opcoes = array(
                            'Ciência, Educação, Inovação'  => 'Ciência, Educação, Inovação',
                            'Práticas Sustentáveis'        => 'Práticas Sustentáveis',
                            'Ciência Alimentando o Brasil' => 'Ciência Alimentando o Brasil',                            
                            );
                    echo form_dropdown( 'subm_area', $opcoes, 'Selecione uma Área' ).'<br>';
                        
                    //echo form_input( $opcoes );    
                    echo '<br>';
                    echo form_label( 'Orientador*', 'subm_orientador' );
                    $data = array( 'name' => 'subm_orientador', 'placeholder' => 'Orientador' );
                    echo form_input( $data );        

                    echo form_label( 'Apoio', 'subm_apoio' );
                    $data = array( 'name' => 'subm_apoio', 'placeholder' => 'Apoio Financeiro' );
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