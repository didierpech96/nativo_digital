<div style="overflow-x: auto;">
        <table class="table table-striped table-hover loader-js">
            <thead>
                <tr>
                    <th>Número de poliza</th>
                    <th>Inicio poliza</th>
                    <th>Vigencia poliza</th>
                    <th>Cliente</th>
                    <th>Aseguradora</th>
                    <th>Tipo de poliza</th>
                    <th>Precio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultados)) { 
                    foreach ($resultados as $key => $r) { ?>
                        <tr>
                            <td><?php echo $r->numero_poliza; ?></td>
                            <td><?php echo $r->fecha_inicio; ?></td>
                            <td><?php echo $r->fecha_vigencia; ?></td>
                            <td><?php echo $r->cliente; ?></td>
                            <td><?php echo $r->aseguradora; ?></td>
                            <td><?php echo $r->tipo_poliza; ?></td>
                            <td>$<?php echo number_format($r->precio,2,".",","); ?></td>
                            <td><?php echo $r->status; ?></td>
                        </tr>
                    <?php } 
                } else { 
                    echo '<tr><td colspan="100">No se encontraron resultados</td></tr>'; 
                } ?>
            </tbody>
        </table>
    </div>
    <?php  echo $this->jquery_pagination->create_links() ?>