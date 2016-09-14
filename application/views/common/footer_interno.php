                    
                    </div><!-- /#col-lg-12 -->
                </div><!-- /#row -->
            </div><!-- /#container-fluid-->
        </div><!-- /#page-content-wrapper -->
    </div><!-- /#wrapper -->
     <!-- assetststrap Core JavaScript -->
        <script src="<?php echo base_url('assets_interno/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets_interno/js/jquery.min.js');?>"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("span", this).toggleClass("glyphicon glyphicon-remove glyphicon glyphicon-menu-hamburger");
    });
    </script>
<!-- Menu Toggle Script -->

</body>
</html>

