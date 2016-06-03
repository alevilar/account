<style>
    .cq-hide{
        display: none;
    }

    

</style>



<!-- style que trabaja en conjunto con JS para mostrar los impuestos en la tabla de listado -->
<style id="style-ss">
    table.listado-gastos .impuestos{
        display: none;
    }

    table.listado-gastos .proveedor-desc{
        font-size: 12px;
        text-align: center;
    }

    table.listado-gastos .obs{
        font-size: 10px;
    }
    
</style>




<?php if (!empty($tipo_impuestos)) { ?>
<a href="#" id="btn-mostrar-impuestos" class="btn btn-link" style="float: right">Mostrar Impuestos</a>
<?php } ?>

<div id="tabla-de-gastos">      
    
<div class="alert alert-info dismiss">Se encontraron <?php echo count($gastos);?> Gastos</div>

    <table class="table table-hover listado-gastos">
        <thead>
            <tr>    
                <th rowspan="2"><input type="checkbox" value="0" id="impt-gastos-select-all"/></th>
                <?php if (!empty($mostrarEgresoInvolucrado)) {?>
                    <th rowspan="2" class="bg-success">Pago</th>
                <?php } ?>
                <th rowspan="2">#</th>
                <th rowspan="2">Clasificación</th>
                <th rowspan="2">Fecha</th>
                <th rowspan="2" data-priority="3">Proveedor</th>
                <th rowspan="2" class="image"><?php echo __('Imagen'); ?></th>
                <th rowspan="2">Tipo</th>
                <th rowspan="2" data-priority="2">N° Factura</th>
                <th rowspan="2" data-priority="1">$Neto</th>
                <?php
                if (!empty($tipo_impuestos)) {
                    foreach ($tipo_impuestos as $ti) {
                        echo "<th colspan='2'  data-priority='5' class='impuestos'>$ti</th>";
                    }
                }
                ?>
                <th class="total" rowspan="2">$Total</th>
                <th class="faltapagar" rowspan="2" data-priority="2">Falta pagar</th>
                <th class="obs-title" rowspan="2" data-priority="3">Observación</th>
                <th class="acciones" rowspan="2">Acciones</th>
            </tr>
            <tr>                
                <?php
                if (!empty($tipo_impuestos)) {
                    foreach ($tipo_impuestos as $ti) {
                        echo "<td class='impuestos'>\$Neto</td><td class='impuestos'>\$Imp.</td>";
                    }
                }
                ?>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($gastos as $g) {
                if (empty($g['Gasto'])) {
                    // falback cuando viene de un contain de otro Model

                    $g['Gasto']['id'] = $g['id'];
                    $g['Gasto']['cierre_id'] = $g['cierre_id'];
                    $g['Gasto']['proveedor_id'] = $g['proveedor_id'];
                    $g['Gasto']['clasificacion_id'] = $g['clasificacion_id'];
                    $g['Gasto']['tipo_factura_id'] = $g['tipo_factura_id'];
                    $g['Gasto']['factura_nro'] = $g['factura_nro'];
                    $g['Gasto']['factura_nro'] = $g['factura_nro'];
                    $g['Gasto']['fecha'] = $g['fecha'];
                    $g['Gasto']['importe_neto'] = $g['importe_neto'];
                    $g['Gasto']['importe_total'] = $g['importe_total'];
                    $g['Gasto']['observacion'] = $g['observacion'];
                    $g['Gasto']['file'] = $g['file'];
                    $g['Gasto']['media_id'] = $g['media_id'];
                    $g['Gasto']['created'] = $g['created'];
                    $g['Gasto']['modified'] = $g['modified'];                   
                }
                
                $classpagado = 'pagado';

                if (empty($g['Gasto']['importe_pagado'])) {
                    $g['Gasto']['importe_pagado'] = ClassRegistry::init('Account.Gasto')->importePagado($g['Gasto']['id']);
                }
                $faltaPagar = abs($g['Gasto']['importe_total']) - abs($g['Gasto']['importe_pagado']);
                if ($g['Gasto']['importe_pagado'] < $g['Gasto']['importe_total']) {
                    $classpagado = 'danger';
                }

                ?>
                <tr class="<?php echo $classpagado; ?>">
                    <?php
                    $meterInput = "";
                    if (empty($g['Gasto']['cierre_id'])) {
                        // abierto
                        $meterInput = "<input type='checkbox' name='data[Gasto][" . $g['Gasto']['id'] . "][id]' value='" . $g['Gasto']['id'] . "'/>";
                    } else {
                        // cerrado
                        $cierreTitle = $g['Cierre']['name'];
                        $meterInput = $this->Html->link(
                        	"<span class='glyphicon glyphicon-saved' title='$cierreTitle'></span>", 
                        	array(
                        		'controller'=>'cierres', 
                        		'action' => 'view', 
                        		$g['Gasto']['cierre_id']
                    		),
                         	array(
                         		'escape' => false,
                         		'target' => '_blank',
                     		)
                     	);
                    }

                    echo "<td>$meterInput</td>";

                    if (!empty($g['AccountEgresosGasto'])) {

                        echo '<td class="bg-success">'.$this->Number->currency($g['AccountEgresosGasto']['importe']).'</td>';
                    }



                    echo "<td>" . $g['Gasto']['id'] . "</td>";
                    if (!empty($g['Clasificacion'])) {
                        echo "<td>" . $g['Clasificacion']['name'] . "</td>";
                    } else {
                        echo "<td>Sin Clasificar</td>";
                    }

                    echo "<td class='fecha'>" . $this->Time->format($g['Gasto']['fecha'], '%d %b' ) . "</td>";


                    if (!empty($g['Proveedor']) && !empty($g['Proveedor']['id'])) {
                        echo "<td class='proveedor-desc'>" . $g['Proveedor']['name'];
                        if (!empty($g['Proveedor']['cuit'])) {
                            echo '<br><small>CUIT: ' .
                                $g['Proveedor']['cuit'] . '</small>';
                        }
                        echo "</td>";
                    } else {
                        echo "<td class='proveedor-desc'></td>";
                    }
                    
                    
                    
                    
                    echo "<td class='center image'>";
                    echo $this->Html->mediaLink( $g['Media'], array('width'=>'68', 'img-modal'=>true) );
                    echo "</td>";

                    if (!empty($g['TipoFactura'])) {
                        echo "<td>" . $g['TipoFactura']['name'] . "</td>";
                    } else {
                        echo "<td></td>";
                    }

                    echo "<td>" . $g['Gasto']['factura_nro'] . "</td>";
                    echo "<td>" . $this->Number->currency($g['Gasto']['importe_neto']) . "</td>";
                    ?>

                    <?php
                    if (!empty($tipo_impuestos)) {

                        foreach ($tipo_impuestos as $tid => $ti) {
                            if (!empty($g['Impuesto'])) {
                                echo "<td class='impuestos'>" . mostrarNetoDe($tid, $g['Impuesto']) . "</td>";
                            } else {
                                echo "<td class='impuestos'></td>";
                            }
                            if (!empty($g['Impuesto'])) {
                                echo "<td class='impuestos'>" . mostrarImpuestoDe($tid, $g['Impuesto']) . "</td>";
                            } else {
                                echo "<td class='impuestos'></td>";
                            }
                        }
                    }

                    echo "<td class='total'>" . $this->Number->currency($g['Gasto']['importe_total']) . "</td>";

                    echo "<td class='faltapagar'>".$this->Number->currency($faltaPagar)."</td>";
                    echo "<td class='obs'>" . $g['Gasto']['observacion'] . "</td>";

                    $linkPagar = '';
                    if ($faltaPagar) {
                        $linkPagar = $this->Html->link(__('Pagar', true), array(
                            'controller' => 'egresos',
                            'action' => 'add', $g['Gasto']['id']), array(
                            'data-ajax' => 'false',
                            'class' => 'btn-edit'
                        ));
                    }
                    ?>
                    <td>
                        <div class="btn-group">
                            <?php $btnClass = $linkPagar?'btn-primary':'';?>
                            <button type="button" class="btn btn-default <?php echo $btnClass ?> dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php echo $linkPagar ? "<li>$linkPagar</li>" : ''; ?>
                                <li><?php echo $this->Html->link('Ver', array(
                                    'controller' => 'gastos',
                                    'action' => 'view', 
                                    $g['Gasto']['id'])) ?></li>
                                
                                <?php if ( empty($g['Gasto']['cierre_id']) ) { ?>
                                <li><?php echo $this->Html->link('Editar', array(
                                    'controller' => 'gastos',
                                    'action' => 'edit', $g['Gasto']['id']), array('data-ajax' => 'false', 'class'=>'btn-edit')) ?></li>
                                <li><?php echo $this->Html->link('Borrar', array(
                                    'controller' => 'gastos',
                                    'action' => 'delete', $g['Gasto']['id'])) ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </td>
                    <?php
                }
                ?>
            </tr>

        </tbody>
    </table>

</div>


<?php $this->append("script") ?>
<script type="text/javascript">


    (function() {
        var $lala = $("#style-ss");
        var show = false;
        var $impu = $('#btn-mostrar-impuestos');
        $impu.click(function() {
            if (show) {
                // ocultar
                $(document.body).prepend($lala);
                show = !show;
                $impu.html("Mostrar Impuestos");
            } else {
                // mostrar
                $impu.html("Ocultar Impuestos");
                $lala = $lala.remove();
                show = !show;
            }
            $impu.addClass('active');
            return false;
        });

        var $inputs = $('tbody', '#tabla-de-gastos').find('input[type=checkbox]');

        function changeInputs() {
            var
                    // inputs from table
                    $ck = $('tbody', '#tabla-de-gastos').find('input[type=checkbox]:checked'),
                    //form input containter
                    $placeForImputs = $('#place-for-inputs').html('');

            // clone inputs from table to form
            $ck.clone().appendTo($placeForImputs);

            // poner cantidad de gastos
            $('.detalle-gastos', '#descripcion-cierre').text($ck.length);
        }

        $('#impt-gastos-select-all').bind('change', function(e) {
            $inputs.each(function(k, i) {
                i.checked = e.currentTarget.checked;
            });
            changeInputs();
        });


        $inputs.bind('change', changeInputs);


        $('#btn-gastos-apli-cierre').bind('click', function(e) {
            var $ck = $('tbody', '#tabla-de-gastos').find('input[type=checkbox]:checked');

            if (!$ck.length) {
                alert('Debe seleccionar algún gasto');
            } else {
                $('#descripcion-cierre').show('fade');
            }

        });

    })();

</script>
<?php $this->end();?>