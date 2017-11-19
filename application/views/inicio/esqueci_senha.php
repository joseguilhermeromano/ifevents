<!-- Container (Login Section) -->
<div id="login" class="section" >
    <div class="align">
        <div class="grid">

            <?php echo form_open('esqueci-minha-senha', array('class'=> 'form login'));?>

              <header class="login__header">
                <h3 class="login__title">Redefinição de Senha</h3>
              </header>
               
              <div class="login__body">
                <?php

                    $this->load->helper('html');
                    echo alert($this->session);

                           ?>
                <p style="font-size: 14px">Por favor, para que seja possível redefinir a sua senha, informe o seu e-mail!
                    Uma mensagem será enviada para o seu e-mail com o link e o passo a passo para redefinição de senha!<br><br>
                  </p>
                <div class="form__field">
                  <input type="email" name="email" placeholder="E-mail" required>
                </div>
              </div>

              <footer class="login__footer">
                <input class="btn btn-success" type="submit" value="Enviar">
                <a class="btn btn-default" href="javascript: window.history.back();"> Voltar</a>
              </footer>
            </form>

          </div>
        </div>
</div>


