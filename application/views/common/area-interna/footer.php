
                    </div><!-- /#col-lg-12 -->
                </div><!-- /#row -->
            </div><!-- /#container-fluid-->
        </div><!-- /#page-content-wrapper -->
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

     <!-- assetststrap Core JavaScript -->
     <!--bootstrap -->
        <script src="<?php echo base_url('assets/area-interna/js/jquery.min.js');?>"></script>
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
        <script src="<?php echo base_url('assets/area-interna/js/bootstrap-file-input-canvas-to-blob.min.js'); ?>">
        </script>
        <script src="<?php echo base_url('assets/area-interna/js/bootstrap-file-input-sortable.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/bootstrap-file-input-purify.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/bootstrap-file-input-fileinput.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/bootstrap-file-input-theme.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/pt-BR.js'); ?>"></script>
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

    // initialize with defaults
    $("#file").fileinput({
        // setup initial preview with data keys
        initialPreviewConfig: [
                {caption:'teste.jpg'}
        ],
        initialPreview: [
            "<img src='http://192.168.1.5/ifevents/application/views/imagens/edicoes/img_1_semcitec.jpg' class='file-preview-image kv-preview-data img-responsive' style='with:auto; height: 160px' title='teste' >",

           
        ]
         // "<img src='/images/jellyfish.jpg' class='file-preview-image' alt='Jelly Fish' title='Jelly Fish'>",
        // initial preview configuration
        // initialPreviewConfig: [
        //     {
        //         caption: 'desert.jpg',
        //         width: '120px'
        //         // key: 100,
        //         // extra: {id: 100}
        //     },
        //     {
        //         caption: 'jellyfish.jpg', 
        //         width: '120px'
                // url: '/localhost/avatar/delete', 
                // key: 101, 
                // frameClass: 'my-custom-frame-css',
                // frameAttr: {
                //     style: 'height:80px',
                //     title: 'My Custom Title',
                // }
                // extra: function() { 
                //     return {id: $("#id").val()};
                // },
        //     }
        // ]
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


<!-- Menu Toggle Script -->
</body>
</html>
