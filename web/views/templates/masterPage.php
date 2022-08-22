<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <base href="<?php echo base_url(); ?>"/>
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=0.41, maximum-scale=1" /> -->
    <!-- Bootstrap -->
    <link href="source/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="source/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="source/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="source/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="source/css/custom.min.css" rel="stylesheet">
    <link href="source/css/layout_1.css" rel="stylesheet">
    <link href="source/css/general.css?1.0.0" rel="stylesheet">
    <!-- jQuery -->
    <script src="source/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="source/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Selectize -->
    <script src="source/vendors/selectpicker/js/bootstrap-select.js"></script>
    <script src="source/vendors/selectpicker/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" type="text/css" href="source/vendors/selectpicker/css/bootstrap-select.css">
    <!-- PNotify -->
    <link href="source/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="source/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="source/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <script src="source/vendors/pnotify/dist/pnotify.js"></script>
    <script src="source/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="source/vendors/pnotify/dist/pnotify.nonblock.js"></script>      
    <!-- Datatables -->
    <link href="source/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="source/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="source/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="source/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="source/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="source/vendors/elegant-icons/elegant-icons-style.css" rel="stylesheet">
    <script src="source/vendors/waitingDialog/bootstrap-waitingfor.js"></script>
    <script src="source/vendors/moment/moment.js"></script>
    <script src="source/js/general.js"></script>
    <!-- Responsive tables -->
    <script src="source/js/basictable/jquery.basictable.js"></script>
    <link href="source/js/basictable/basictable.css" rel="stylesheet">
    <script src="source/js/modales.js"></script>
    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>
    <?php
        if(isset($css)){
            if(!empty($css)){
                foreach ($css as $key) {
                   echo '<link rel="stylesheet" type="text/css" href="source/'.$key.'">';
                }
            }
        }
    ?>
    <?php
        if(isset($js)){
            if(!empty($js)){
                foreach ($js as $key) {
                   echo '<script src="source/'.$key.'"></script>';
                }
            }
        }
    ?>
</head>
<body class="nav-md" style="width: 100%; height: 100%; position: relative;">
    <div id="loader" style="display: none"><span class="fa fa-spinner fa-spin"></span></div>
    <div id="gesture-hover-menu" class="visible-xs" style="height: 100%; width: 15px; background: transparent; position: absolute; z-index: 9;"></div>
    <div class="container body">
        <div class="main_container">
            <?php echo modules::run('menu/menu/index'); ?>        
            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 1161px;">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo $contenido; ?>
                </div>
            </div>
        </div>
            <?php echo modules::run('footer/footer/index'); ?>
        </div>
    </div>
    <!-- FastClick -->
    <script src="source/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="source/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="source/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="source/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="source/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="source/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="source/js/jquery.slimscroll.js"></script>
    <script src="source/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

                <script>
                    $("#section-data-list table").basictable();
            $(document).ready(function() {

              $('.sidebar-inner').slimscroll();
                    
            });

function initscrolls(){
    if(jQuery.browser.mobile !== true){
      //SLIM SCROLL
      $('.slimscroller').slimscroll({
        height: 'auto',
        size: "5px"
      });

      $('.slimscrollleft').slimScroll({
          height: '100%',
          position: 'right',
          size: "6px",
          color: '#ca8336',
          alwaysVisible: true,
          railColor:'white',
          railOpcacity:1,
          wheelStep: 5,
          opacity:0.9,
          railVisible : true,
          distance: '0px',

        // sets rail color
        railColor : '#59656F',

        // sets rail opacity
        railOpacity : 1,
                // sets border radius
        borderRadius: '0px',

        // sets border radius of the rail
        railBorderRadius : '0px'
      });
  }
}
function toggle_slimscroll(item){
    if($("#wrapper").hasClass("enlarged")){
      $(item).css("overflow","inherit").parent().css("overflow","inherit");
      $(item). siblings(".slimScrollBar").css("visibility","hidden");
    }else{
      // $(item).css("overflow","hidden").parent().css("overflow","hidden");
      // $(item). siblings(".slimScrollBar").css("visibility","visible");
    }
}
        </script>
    <!-- Custom Theme Scripts -->
    <script src="source/js/custom.min.js"></script>
</body>
</html>