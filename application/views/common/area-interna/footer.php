                    
                    </div><!-- /#col-lg-12 -->
                </div><!-- /#row -->
            </div><!-- /#container-fluid-->
        </div><!-- /#page-content-wrapper -->
    </div><!-- /#wrapper -->
     <!-- assetststrap Core JavaScript -->
        <script src="<?php echo base_url('assets/area-interna/js/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/jquery.maskedinput.js');?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/jquery-ui.js');?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/select2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/area-interna/js/adicionaCampos.js');?>"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("span", this).toggleClass("glyphicon glyphicon-remove glyphicon glyphicon-menu-hamburger");
    });
    </script>

    <script>
        jQuery(function($){
               $("#campoData").mask("99/99/9999");
               $("#campoTelefone").mask("(99) 9999-9999");
               $("#campoCep").mask("99999-999");
               $("#campoSenha").mask("***-****");
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
