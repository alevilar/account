<table class="table table-hover">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>#</th>
            <th>Importe</th>
            <th>Fecha</th>
            <th>Cant. Gastos</th>
            <th>Listado de Gastos descontados en este Pago</th>
            <th>Obs.</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>


    <tbody>
        <?php foreach ($egresos as $g) { ?>

            <tr>
                <td>
                    <?php echo $this->Html->imageMedia($g['TipoDePago']['media_id'], array('class' => 'thumb')); ?>
                </td>
                
                <td><?php echo $g['Egreso']['id']; ?></td>

                <td><?php echo $this->Number->currency($g['Egreso']['total']); ?></td>

                <td><?php echo $this->Time->format($g['Egreso']['fecha'], '%d %b'); ?></td>


                <td><?php echo count($g['Gasto']); ?></td>                
                
                <td>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Factura</th>
                                <th>Fecha</th>
                                <th>Neto</th>
                                <th>Total</th>
                                <th>Pago</th>
                                <th>Obs.</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            $proveedor = '';
                            $tipoFactura = '';

                            foreach ( $g['Gasto'] as $gasto ) {
                                if ( !empty($gasto['Proveedor']) ) {
                                    $proveedor = $gasto['Proveedor']['name'];
                                }
                                if ( !empty($gasto['TipoFactura']) ) {
                                    $tipoFactura = $gasto['TipoFactura']['name'];
                                }
                                ?>
                                <tr>                                    
                                    <td><?php echo $proveedor ?></td>
                                    <td><?php echo $tipoFactura ?> <?php echo $gasto['factura_nro'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($gasto['fecha'])) ?></td>
                                    <td><?php echo $gasto['importe_neto'] ?></td>
                                    <td><?php echo $gasto['importe_total'] ?></td>
                                    <td class="text text-warning"><?php echo $this->Number->currency($gasto['AccountEgresosGasto']['importe']) ?></td>
                                    <td><?php echo $gasto['observacion'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                <td><?php echo $g['Egreso']['observacion']; ?></td>

                <td>
                     <?php echo $this->Html->mediaLink( $g['Egreso']['media_id'], array('height'=>'40px', 'img-modal'=>true)); ?>
                </td>

                <td>
                    <?php
                    echo $this->Html->link('Ver', array('plugin' => 'account', 'controller' => 'egresos', 'action' => 'view', $g['Egreso']['id']));
                    echo "<br>";
                    echo $this->Html->link('Editar', array('plugin' => 'account', 'controller' => 'egresos', 'action' => 'edit', $g['Egreso']['id']), array('class'=>'btn-edit'));
                    echo "<br>";
                    echo $this->Html->link('Eliminar', array('plugin' => 'account', 'controller' => 'egresos', 'action'=>'delete', $g['Egreso']['id']), null, sprintf(__('¿Está seguro que desea borrar el pago de %s', true), $this->Number->currency($g['Egreso']['total'])));
                    ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>