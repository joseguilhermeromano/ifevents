<!-- Container (Login Section) -->
<div id="login" class="section" >
    <div class="align">
        <div class="grid">

              <header class="login__header">
                <h3 class="login__title">Redefinição de Senha</h3>
              </header>
               
              <div class="login__body">
                <?php

                    $this->load->helper('html');
                    echo alert($this->session);

                           ?>
              </div>

              <footer class="login__footer">
                <a class="btn btn-default" href="<?= base_url('login'); ?>"> Ir para o login</a>
              </footer>

          </div>
        </div>
</div>


