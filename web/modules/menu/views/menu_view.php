<script src="sistema/js/views_front/menus.js?1.0.1"></script>
<style type="text/css">
  @media (max-width: 520px){
    .nav.navbar-nav.navbar-right .notificaciones ul{
      width: 300px !important;
    }
  }
  @media (min-width: 521px) and (max-width: 720px){
    .nav.navbar-nav.navbar-right .notificaciones ul{
      width: 400px !important;
    }
  }
  .contador_notificaciones{
    display: none;
  }
  .icono_notificaciones.no_vistos{
    position: absolute; 
    top: 20px;
  }
  .icono_notificaciones.no_vistos+.contador_notificaciones{
    display: initial !important;
    border-radius: 15px;
    right: -10px;
    position: relative;
    top: -10px;
    background: red;
    padding: 2px 6px;
  }
  .icono_notificaciones.no_vistos+.contador_notificaciones.mas_9{
    padding: 2px 3px !important;
  }
</style>
<div id="sidebar-menu-content-backdrop" style="background: transparent; min-height: 100%; width: 100%; height: auto !important; position: fixed; top:0; left: 0; z-index: 10; visibility: 0; display: none; background: rgba(0,0,0,0.1);">
</div>
<div class="left side-menu" style="z-index: 10 !important; position: fixed !important; top: 0px" id="menu-col">
<div style="height: 100%">
<div class="sidebar-inner" style="padding-top: 60px; bottom: 50px">
  <!--- Divider -->
  <div id="sidebar-menu">
    <div class="navbar nav_title">
      <a href="dashboard" class="site_title"><span>Nativo Digital</span></a>
    </div>
    
    <ul class="nav side-menu" id="search-result" style="display: none">
      <li>
        <a style="background: rgba(255,255,255,.05)"><i class="fa fa-filter"></i> Resultados <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" id="search-results">
        </ul>
      </li>
    </ul>
    <ul class="" id="totalMain" style="margin-bottom: 50px">
      <li class="child_main"><a href="dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="child_main"><a href="Clientes"><i class="fa fa-user"></i> Clientes</a></li>
      <li class="child_main"><a href="Poliza"><i class="fa fa-user"></i> Polizas</a></li>
      
    </ul>
  </div>
  <div class="clearfix"></div>
              <!-- /sidebar menu -->
</div>
</div>

<!-- /menu footer buttons -->
<div class="sidebar-footer" style="margin-top: 60px; position: absolute;width: 100%">
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login/logout">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->
</div>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="show-hide-menu"><i class="fa fa-bars"></i></a>
      </div>
      <?php $user = $user[0]; ?>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="source/images/user.png" alt=""><?php echo $user->nombre_completo; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right" style="z-index: -1">
            <!-- <li><a href="usuarios/perfil"> Perfil</a></li> -->
            <!-- <li>
              <a href="javascript:;">
                <span class="badge bg-red pull-right">50%</span>
                <span>Settings</span>
              </a>
            </li> -->
            <li><a href="login/logout"><i class="fa fa-sign-out pull-right"></i> Cerrar sesion</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->