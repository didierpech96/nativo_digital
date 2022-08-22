<?php echo breadcum(); ?>
<div class="x_panel">
  <div class="x_title">
    <div id="action-buttons">
      <a href="poliza/add" class="pull-left"><i class="fa fa-plus-circle" style='color:#00C853;' aria-hidden="true"></i> Agregar</a>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div id="section-search" style="display: none;">
      <form action="roles/f_paginacion_ajax" role="form" method="post" target="#paginacion">
        <!-- <div class="col-md-1 col-sm-1 col-xs-12 form-group">
          <input type="text" name="id_rol" class="form-control" placeholder="#">
        </div> -->
        <div class="col-md-2 col-sm-2 col-xs-12 form-group">
          <input type="text" name="rol" class="form-control" placeholder="Rol">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12">
          <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i></button>
          <a href="<?php echo $this->router->class; ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
        </div>
      </form>
      <hr style="margin: 10px 0">
    </div>
    <div id="section-loader" style="display: none;">
      <div style="display: table; width: 100%; min-height: 300px; text-align: center;"><div style="display: table-cell; vertical-align: middle;"><i class="fa fa-spin fa-spinner" style="font-size: 50px"></i></div></div>
    </div>
    <div id="section-data-list">
      <?php echo $table; ?>
    </div>
  </div>
</div>