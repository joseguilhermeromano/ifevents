<!-- Container (Login Section) -->
<div id="login" class="section" >
    <div class="align">
        <div class="grid">

            <?php echo form_open('login/entrar', array('class'=> 'form login'));?>

              <header class="login__header">
                <h3 class="login__title">Login</h3>
              </header>

              <div class="login__body">
                <?php

                    $this->load->helper('html');
                    echo alert($this->session);

                           ?>
                <div class="form__field">
                  <input type="email" name="email" placeholder="E-mail" required>
                </div>

                <div class="form__field">
                  <input type="password" name="senha" placeholder="Senha" required>
                </div>
                  <hr>
                <h4 class="text-center">Não tem uma Conta? 
                <a style="color:#969690;" href="<?php echo base_url('inicio/cadastrar/participante'); ?>">Cadastra-se</a></h4>
              </div>

              <footer class="login__footer">
                <input class="btn btn-success" type="submit" value="Login">

                <p><span class="icon icon--info"><i class="fa fa-pencil"></i></span>
                    <a class="esqueci_senha" href="<?php echo base_url('esqueci-minha-senha'); ?>">Esqueci minha senha</a></p>
              </footer>
            </form>

          </div>
        </div>
</div>
