function nueva_fila(obj){

	html = '<tr>'
              +'<td><input type="text" name="nombre_asegurado[]" class="form-control" required=""></td>'
              +'<td><input type="number" name="edad_asegurado[]" class="form-control" required=""></td>'
              +'<td><button type="button" class="btn btn-danger" onclick="borrar_fila(this)">Eliminar</button></td>'
            +'</tr>';

	$(obj).closest("tr").before(html);
}
function borrar_fila(obj){
	$(obj).closest('tr').remove();
}