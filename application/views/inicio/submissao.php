   

    <section id="submissao" class="tod">
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Submissão de Projetos</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                <div class="">
                    <p>Leia atentamente os arquivos aqui disponíveis caso queira submeter algum projeto.</p>
                    <!--<p>Entre em contato pelo e-mail: semciteccoordenacao@gmail.com</p>-->
                    <br><br>
                    <h5><a href="arquivos/Eixos.pdf" download="Eixos"> • Eixos para Submissão • </a></h5>
                    <br>
                    <h5><a href="arquivos/SelecaoSubmissao.pdf" download="Normas e Critérios"> • Normas e Critérios para Submissão e Seleção • </a></h5>
                    <br>
                    <h5><a href="arquivos/Submissao.pdf" download="Submissão de Projetos"> • Submissão de Projetos • </a></h5>
                    <br>
                    <h5><a href="arquivos/Resumos.pdf" download="Resumos"> • Resumo e Resumo Expandido • </a></h5>
                    <br>
                    <h5><a href="arquivos/AvaliacaoPremiacao.pdf" download="Avaliação, Certificação, Premiação"> • Avaliação, Certificação, Premiação • </a></h5>
                    <br>
                    <h5><a href="arquivos/ModelosAceitos.pdf" download="Modelos - Regras"> • Sobre os Modelos Aceitos • </a></h5>
                    <br>
                    <h5><a href="arquivos/Normas1.pdf" download="Normas para Submissão de Pesquisa Científica"> • Normas para Submissão De Pesquisa Científica • </a></h5>
                    <br>
                    <h5><a href="arquivos/Normas2.pdf" download="Normas para Submissão de Relatos de Experiência"> • Normas para Submissão de Relatos de Experiência • </a></h5>
                    <br>
                </div>
            </div>
        </div>

	</section>
	<section>
	   <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h2>Submissão</h2>
                                <hr class="star-primary">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                            <p>
                                Para submeter o seu projeto preencha o formulário de Submissão de Artigos.
                            </p>
                                <button onclick="aparece('formularioParticipante');">Cadastro de Projetos</button>
                                <br><br><br><br><br>
                            </div>                                                        
                        </div>
        <section id="formularioParticipante" style="display: none;">
            <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h3>Cadastro de Projetos</h3>
                                <hr class="star-primary">
                            </div>
                        </div>
            <?php echo form_open_multipart('InicioControl/submitCadastro', 'role="form" class="formsignin"'); ?>
                        <div class="row text">
                            <div class="col-lg-8 col-lg-offset-2">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="file" class="form-control" name="userfile" placeholder="Escolha o Arquivo" autofocus>
                                </br>
                            </div>
                        </div>    
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="RA" placeholder="Registro Acadêmico" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="autor" placeholder="Autor(es)" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="instituicao" placeholder="Instituição" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                            	<input type="text" class="form-control" name="resumo" placeholder="Resumo" autofocus>
                                </br>
                            </div>
                        </div>                       

                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">                            	                          	
                                <select class="form-control" name="artigo">
                                <option value="">Selecione a Área</option> 
                                <option value="1">Automação Indústrial</option>
                                <option value="1">Análise e Desenvolvimento de Sistemas</option>
                                <option value="1">Matemática</option>
                                <option value="1">Engenharia de Software</option>         
                                </br>
                                </select>
                            </div>
                        </div>	


                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="orientador" placeholder="Orientador" autofocus>
                                </br>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="financeiro" placeholder="Apoio Financeiro" autofocus>
                                </br>
                            </div>
                        </div>
                        
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <input type="text" class="form-control" name="RA" placeholder="RA" autofocus>
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

    </section>       


                 