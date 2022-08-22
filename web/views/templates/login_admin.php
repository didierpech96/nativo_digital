<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <base href="<?php echo $this->config->item('base_url'); ?>"/>
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- Bootstrap -->
    <link href="source/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="source/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="source/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="source/vendors/animate.css/animate.min.css" rel="stylesheet">
    <script src="source/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="source/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="source/js/general.js"></script>
    <script src="source/vendors/waitingDialog/bootstrap-waitingfor.js"></script>
    <!-- PNotify -->
    <link href="source/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="source/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="source/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <script src="source/vendors/pnotify/dist/pnotify.js"></script>
    <script src="source/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="source/vendors/pnotify/dist/pnotify.nonblock.js"></script>       
    <style type="text/css">
      .login_content form div a{
        margin: 0 !important;
      }
      #errors p{
        text-align: left;
      }
      body{
        /*background: #59237b !important;*/
        color: white !important;
        text-shadow: none !important;
      }
      a,h1,h2,h3,h4,p{
        color: white !important;
        text-shadow: none !important;
      }
      input{
        box-shadow: none !important;
      }
    </style>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#login form").submit(function(e) {
          e.preventDefault();
          obj = this;
          $.ajax({
            url: 'login/ingresar',
            type: 'POST',
            dataType: 'json',
            data: $(obj).serialize(),
            success:function(res){
              if(res["estatus"] == 1){
                completo(res["mensaje"]);
                $("[type='submit']",obj).attr("disabled","disabled");
                location.href = (res["redirect"] != "") ? res["redirect"] : "dashboard";
              }else{
                errores(res["mensaje"]);
              }
            },error:function(){
              errores("<p>Ocurrió un error inesperado</p>");
            }
          });
        });
      });
    </script>
    <!-- Custom Theme Style -->
    <link href="source/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div class="login_wrapper">
      <div class="animate form login_form fadeInLeft" id="login">
        <section class="login_content">
          <form>
            <!-- <img src="source/images/logo.png" class="img-responsive"> -->
            <h1>Ingresa a tu cuenta</h1>
              <input type="text" name="usuario" class="form-control" placeholder="Username" required="" />
              <input type="password" name="password" min="6" class="form-control" placeholder="Password" required="" />
            <div id="errors" class="errors"></div>
            <div id="ingresar">
              <button type="submit" class="btn btn-primary submit pull-left">Ingresar</button>
              <a class="reset_pass" href="source/javascript:void(0);">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
                <!-- <h1><i class="fa fa-code"></i> Omnilife</h1> -->
            </div>
          </form>
        </section>
      </div>
    </div>
  </body>
</html>
