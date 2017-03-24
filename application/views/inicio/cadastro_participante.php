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
            <div class="col-lg-12">
                <p class="text-left">OBS: Caso você seja Revisor ou Organizador e deseja se cadastrar, envie uma mensagem de contato, para que seja possível receber o link de  cadastro!</p><br>
                <?php 
                    include_once("application/views/formularios/novo-usuario.php");
                ?>
            </div>
        </div>
    </div>
</div>
