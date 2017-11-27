
                    </div><!-- /#col-lg-12 -->
                </div><!-- /#row -->
            </div><!-- /#container-fluid-->
        </div><!-- /#page-content-wrapper -->
        <div class="clear"></div>
    </div><!-- /#wrapper -->

    <!-- Modal de Exclusão -->
        <div id="modalExcluir" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Excluir</h4>
                    </div>
                    <div class="modal-body">

                        <p>Deseja realmente excluir este registro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                        <button class="btn btn-success" onclick="Executa();">Continuar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Atualização -->
            <div id="modalAtualizar" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Atualizar</h4>
                        </div>
                        <div class="modal-body">

                            <p>Deseja realmente atualizar este registro?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                            <button class="btn btn-success" onclick="Executa();">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Modal de Ativa/Desativa -->
        <div id="modalAtivar" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Ativar Usuário</h4>
                    </div>
                    <div class="modal-body">
                        <p>Deseja realmente ativar este usuário?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                        <button class="btn btn-success" onclick="Executa();">Continuar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Ativa/Desativa -->
        <div id="modalDesativar" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Desativar Usuário</h4>
                    </div>
                    <div class="modal-body">
                        <p>Deseja realmente desativar este usuário?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                        <button class="btn btn-success" onclick="Executa();">Continuar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal de Confirmar Revisao -->
        <div id="modalConfirmarRevisao" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Confirmar Revisão</h4>
                    </div>
                    <div class="modal-body">
                        <p>Deseja realmente confirmar o resultado desta revisão?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" onclick="Executa();">Sim</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Não</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Cancelamento -->
            <div id="modalCancelar" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Cancelar</h4>
                        </div>
                        <div class="modal-body">

                            <p>Deseja realmente cancelar a inscrição?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                            <button class="btn btn-success" onclick="Executa();">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>




     <!-- assetststrap Core JavaScript -->
     <!--bootsecho trap -->
        <script src="<?php echo base_url('assets/area-interna/js/jquery-3.2.1.js');?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/bootstrap.min.js'); ?>"></script>
    <!-- metodos para as modais -->
        <script src="<?php echo base_url('assets/area-interna/js/metodosModais.js'); ?>"></script>
    <!-- plugin jquery masked input -->
        <script src="<?php echo base_url('assets/ambas-areas/js/jquery.maskedinput.js');?>"></script>
    <!-- plugins para calendario jquery -->
        <script src="<?php echo base_url('assets/ambas-areas/js/jquery-ui.js');?>"></script>
        <script src="<?php echo base_url('assets/ambas-areas/js/jquery.dataTables.min.js');?>"></script>
    <!-- plugin select 2 jquery -->
        <script src="<?php echo base_url('assets/ambas-areas/js/select2.min.js');?>"></script>
    <!-- consultas ajax e implementação de alguns plugins -->
        <script src="<?php echo base_url('assets/ambas-areas/js/adicionaCampos.js');?>"></script>
    <!-- plugin bootstrap file input -->
        <script src="<?php echo base_url('assets/area-interna/file-input/js/plugins/piexif.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/area-interna/file-input/js/plugins/sortable.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/file-input/js/plugins/purify.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/area-interna/file-input/js/fileinput.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/file-input/themes/fa/theme.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/file-input/themes/explorer/theme.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/file-input/themes/gly/theme.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/file-input/js/locales/pt-BR.js'); ?>"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $(this).hide();
        // $("span", this).toggleClass("glyphicon glyphicon-remove glyphicon glyphicon-menu-hamburger");
    });
    $("#close-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
         $("#menu-toggle").show();
        // $("span", this).toggleClass("glyphicon glyphicon-remove glyphicon glyphicon-menu-hamburger");
    });

    </script>

    <script>



        function MostrarEsconderPainel(parametro,header){
            $(parametro).toggle(500);
            $("span",header).toggleClass("glyphicon glyphicon-triangle-right glyphicon glyphicon-triangle-bottom");
        }

        function MostrarEsconderLinha(parametro){
            $(parametro).toggle(function () {
                    $(this).animate({left:'250px'}, 300);
                },
                function () {
                    $(this).animate({left:'0'}, 300); // Aqui volta para o Zero, lugar inicial
                }
            );
        }
    </script>

    <script>
        function show(msg){
            if(document.getElementById(msg).style.display== "none"){
                document.getElementById(msg).style.display = "block";
            }
            else {
                document.getElementById(msg).style.display = "none"
            }
        }
    </script>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>


<!-- Menu Toggle Script -->
</body>
</html>
