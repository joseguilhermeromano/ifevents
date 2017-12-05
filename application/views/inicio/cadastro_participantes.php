<div id="inicio">
  <div class="inicio-header">
    <div class="banner">
      <img class="img-responsive banner-image" src="<?php echo base_url("assets/area-externa/img/banner-cadastro.jpg"); ?>" width="100%">
    </div>
    <div class="display-middle margin-top">
      <h4>IFEVENTS</h4>
      <h1>CADASTRE-SE</h1>
      <hr>
        <!-- arrow bounce --> 
        <div class="agileits-arrow bounce animated"><a href="#cadastro" class="scroll"><i class="glyphicon glyphicon-menu-down" aria-hidden="true"></i></a></div>
        <!-- //arrow bounce -->
    </div>
  </div>
</div>


<div id="cadastro" class="section">
    <div class="container">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="estilo-h1">Cadastro de Participantes</h1>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        $this->load->helper('html');
                        echo alert($this->session);
                        echo form_open_multipart( $this->uri->uri_string(), 'role="form" class="formsignin" enctype="multipart/form-data"' );
                    ?>
                    <h4 class="subtitulo"><i>Dados de acesso</i></h4><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group controls">
                                <b><?php echo form_label( '*Nome Completo', 'nome' ); ?></b>
                                    <?php $data = array( 'name' => 'nome', 'class' => 'form-control estilo-input',
                                                         'value' => (isset($participante) ? $participante->getNomeCompleto() : ''));
                                    echo form_input($data);?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'Instituição', 'instituicao' ); ?></b><br>
                                    <select name="instituicao" class="form-control estilo-input consultaInstituicao">
                                        <?php   if(isset($participante) && $participante->getInstituicao()!==null){   ?>
                                        <option value="<?php echo $participante->getInstituicao()->getCodigo(); ?>" selected>
                                                      <?php echo $participante->getInstituicao()->getAbreviacao() ?></option>
                                          <?php } ?>
                                    </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group controls">
                                <b><?php echo form_label( '*E-mail', 'email' ); ?></b>
                                <?php $data = array( 'name' => 'email', 'class' => 'form-control estilo-input',
                                                     'value' => (isset($participante) && !empty($participante->getEmail()) ? $participante->getEmail() : ''));
                                              echo form_input( $data );?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group controls" id="confirmaemail" >
                                <b><?php echo form_label( '*Confirmar e-mail', 'confirmaemail' ); ?></b>
                                <?php $data = array( 'name' => 'confirmaemail', 'class' => 'form-control estilo-input' );
                                              echo form_input( $data );?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" id="senha">
                        <div class="col-sm-6">
                            <div class="form-group controls">
                                <b><?php echo form_label( '*Senha', 'senha' ); ?></b>
                                   <?php $data = array( 'name' => 'senha', 'type' => 'password','class' => 'form-control estilo-input' );
                                         echo form_input( $data );?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group controls">
                                <b><?php echo form_label( '*Confirmar Senha', 'confirmasenha' ); ?></b>
                                <?php $data = array( 'name' => 'confirmasenha',  'type' => 'password', 'class' => 'form-control estilo-input');
                                         echo form_input( $data );?>
                            </div>
                        </div>
                    </div>

                    <h4 class="subtitulo"><i>Documentos</i></h4><br>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( '*RG', 'rg' ); ?></b>
                                   <?php $data = array( 'name' => 'rg', 'id' => 'campoRG', 'type' => 'text', 'class' => 'form-control estilo-input',
                                                        'value' => ( isset($participante) ? $participante->getRg() : ''));
                                   echo form_input( $data );?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'CPF', 'cpf' ); ?></b>
                                   <?php $data = array( 'name' => 'cpf', 'id' => 'campoCPF', 'type' => 'text', 'class' => 'form-control estilo-input',
                                                        'value' => ( isset($participante) ? $participante->getCpf() : ''));      
                                   echo form_input( $data );?>
                            </div>
                        </div>
                    </div>

                    <h4 class="subtitulo"><i>Endereço</i></h4><br>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'CEP', 'cep' ); ?></b>
                                   <?php $data = array( 'name' => 'cep', 'id' => 'campoCep', 'class' => 'form-control estilo-input',
                                                    'value' => ( isset($participante) ? $participante->getCep() : ''));
                                        echo form_input( $data );?>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'Logradouro', 'logradouro' ); ?></b>
                                   <?php $data = array( 'name' => 'logradouro', 'class' => 'form-control estilo-input', 'id' => 'logradouro',
                                                        'value' => ( isset($participante) ? $participante->getLogradouro() : ''));
                                         echo form_input( $data );?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'Bairro', 'bairro' ); ?></b>
                                   <?php $data = array( 'name' => 'bairro', 'class' => 'form-control estilo-input', 'id' => 'bairro',
                                                        'value' => ( isset($participante) ? $participante->getBairro() : ''));
                                         echo form_input( $data );?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'Número', 'numero' ); ?></b>
                                   <?php $data = array( 'name' => 'numero', 'class' => 'form-control estilo-input',
                                                        'value' => ( isset($participante) ? $participante->getNumero() : ''));
                                        echo form_input( $data );?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'Complemento', 'complemento' ); ?></b>
                                   <?php $data = array( 'name' => 'complemento', 'class' => 'form-control estilo-input',
                                                        'value' => ( isset($participante) ? $participante->getComplemento() : ''));
                                        echo form_input( $data );?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'Cidade', 'cidade' ); ?></b>
                                   <?php $data = array( 'name' => 'cidade', 'class' => 'form-control estilo-input', 'id' => 'cidade'
                                                        ,'value' => ( isset($participante) ? $participante->getCidade() : ''));
                                         echo form_input( $data );?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'UF', 'uf' ); ?></b>
                                    <select name ="uf" class="form-control estilo-input" id="uf">
                                        <?php $uf = array( 'AC','AL','AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA',
                                                           'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');
                                            foreach($uf as $key => $value){
                                               if(!isset($participante) && $value == 'SP'){
                                                   echo "<option>".$value."</option>";
                                               }else if(isset($participante) && $participante->getUf() !== null && $participante->getUf() == $value){
                                                   echo "<option selected>".$value."</option>";
                                               }else{
                                                   echo "<option>".$value."</option>";
                                               }
                                            }
                                        ?>
                                    </select>
                            </div>
                        </div>
                    </div>

                    <h4 class="subtitulo"><i>Contato</i></h4><br>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group controls">
                                <b><?php echo form_label( 'Telefone/Celular', 'telefone' ); ?></b>
                                   <?php $data = array( 'name' => 'telefone', 'id' => 'campoTelefone', 'class' => 'form-control estilo-input',
                                                        'value' => isset($participante) ? $participante->getTelefone() : '');
                                         echo form_input( $data );?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <?php
                            echo form_submit("btn_cadastro", "cadastrar", array('class' => 'btn btn-success button text-center'))."</center>";
                            echo form_fieldset_close();
                            echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


