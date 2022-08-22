<?php echo breadcum(); ?>
<div class="x_panel">
  <div class="x_title">
    <a href="Clientes"><big>Clientes</big></a> / Nuevo cliente
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <form action="clientes/action_add" method="POST" class="submitjs" redirect="clientes">
      <div class="form-group">
        <label>Nombre completo</label>
        <input type="text" name="nombre_completo" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required="">
      </div>
      <div class="form-group">
       <button type="submit" class="btn btn-primary">Añadir cliente</button>
      </div>
    </form>
  </div>
</div>