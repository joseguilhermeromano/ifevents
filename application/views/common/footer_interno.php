                    
                    </div><!-- /#col-lg-12 -->
                </div><!-- /#row -->
            </div><!-- /#container-fluid-->
        </div><!-- /#page-content-wrapper -->
    </div><!-- /#wrapper -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("span", this).toggleClass("glyphicon glyphicon-remove glyphicon glyphicon-menu-hamburger");
//        if ($("span",this).parent().is(".glyphicon .glyphicon-remove")){
//            return ".glyphicon .glyphicon-menu-hamburger";
//        }else{
//            return ".glyphicon .glyphicon-remove";
//        }
    });
    </script>
<!-- Menu Toggle Script -->
</body>
</html>

