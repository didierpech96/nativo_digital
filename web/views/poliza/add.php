<?php echo breadcum(); ?>
<div class="x_panel">
  <div class="x_title">
    <a href="Poliza"><big>Polizas</big></a> / Nueva poliza
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <form action="poliza/action_add" method="POST" class="submitjs" redirect="poliza">
      <div class="form-group">
        <label>Número de poliza</label>
        <input type="text" name="numero_poliza" class="form-control" required="" maxlength="10">
      </div>
      <div class="form-group">
        <label>Fecha de inicio</label>
        <input type="date" name="fecha_inicio" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Fecha de vigencia</label>
        <input type="date" name="fecha_vigencia" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Cliente</label>
        <select class="form-control" name="cliente">
          <option value="">Seleccione</option>
          <?php foreach ($cliente as $key => $c): ?>
            <option value="<?php echo $c->id_cliente; ?>"><?php echo $c->nombre_completo; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Personas aseguradas</label>
        <table class="table table-bordered">
          <thead>
            <th>Nombre</th>
            <th>Edad</th>
            <th></th>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="nombre_asegurado[]" class="form-control" required=""></td>
              <td><input type="number" name="edad_asegurado[]" class="form-control" required=""></td>
              <td><button type="button" class="btn btn-danger" onclick="borrar_fila(this)">Eliminar</button></td>
            </tr>
            <tr id="nueva-fila">
              <td colspan="3">
                <button type="button" onclick="nueva_fila(this)" class="btn btn-primary btn-block">Nueva fila</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="form-group">
        <label>Aseguradora</label>
        <input type="text" name="aseguradora" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Tipo de poliza</label>
        <select class="form-control" name="tipo_poliza">
          <option value="">Seleccione</option>
          <?php foreach ($tipo_poliza as $key => $tp): ?>
            <option value="<?php echo $tp->id; ?>"><?php echo $tp->tipo_poliza; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <label>Precio</label>
        <input type="number" name="precio" class="form-control" required="">
      </div>
      <div class="form-group">
        <label>Estado de la poliza</label>
        <select class="form-control" name="status">
          <option value="1">Vigente</option>
          <option value="0">Vencida</option>
        </select>
      </div>
      <div class="form-group">
       <button type="submit" class="btn btn-primary">Añadir poliza</button>
      </div>
    </form>
  </div>
</div>