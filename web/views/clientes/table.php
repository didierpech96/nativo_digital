<div style="overflow-x: auto;">
        <table class="table table-striped table-hover loader-js">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultados)) { 
                    foreach ($resultados as $key => $r) { ?>
                        <tr>
                            <td><?php echo $r->nombre_completo; ?></td>
                            <td><?php echo $r->telefono; ?></td>
                            <td><?php echo $r->email; ?></td>
                        </tr>
                    <?php } 
                } else { 
                    echo '<tr><td colspan="100">No se encontraron resultados</td></tr>'; 
                } ?>
            </tbody>
        </table>
    </div>
    <?php  echo $this->jquery_pagination->create_links() ?>