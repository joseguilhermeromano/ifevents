<!-- Container (Login Section) -->
<div id="login" class="section" >
    <div class="align">
        <div class="grid">

            <?php echo form_open($this->uri->uri_string().'?'.$_SERVER['QUERY_STRING'], array('class'=> 'form login'));?>

              <header class="login__header">
                <h3 class="login__title">Redefinição de Senha</h3>
              </header>
               
              <div class="login__body">
                <?php

                    $this->load->helper('html');
                    echo alert($this->session);

                           ?>
                <div class="form__field">
                  <input type="password" name="novasenha" placeholder="Nova Senha" required>
                </div>
                <div class="form__field">
                  <input type="password" name="confirmasenha" placeholder="Confirma a nova senha" required>
                </div>
              </div>

              <footer class="login__footer">
                <input class="btn btn-success" type="submit" value="Alterar Senha">
                <a class="btn btn-default" href="<?= base_url('login');?>"> Cancelar</a>
              </footer>
            </form>

          </div>
        </div>
</div>


