

<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Pago'));?>


<div class="content-white">
<h1>Listado de Pagos</h1>

<?php
echo $this->Html->css('/account/css/style');
echo $this->element('form_mini_year_month_search');

$urlTex = '';
foreach ($this->params['url'] as $u => $v) {
    if ($u != 'ext' && $u != 'url' && $u != 'page') {
        if (!empty($v)) {
            $urlTex .= "$u=$v&";
        }
    }
}
$urlTex = trim($urlTex, '&');
$this->Paginator->options(array('url' => array('?' => $urlTex)));

?>


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
                     <?php echo $this->Html->imageMedia( $g['Media'], array('height'=>'40px')); ?>
                </td>

                <td>
                    <?php
                    echo $this->Html->link('Ver', array('action' => 'view', $g['Egreso']['id']));
                    echo "<br>";
                    echo $this->Html->link('Editar', array('action' => 'edit', $g['Egreso']['id']), array('class'=>'btn-edit'));
                    echo "<br>";
                    echo $this->Html->link('Eliminar', array('action'=>'delete', $g['Egreso']['id']), null, sprintf(__('¿Está seguro que desea borrar el pago de %s', true), $this->Number->currency($g['Egreso']['total'])));
                    ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>
		<p>
    	<?php
    	echo $this->Paginator->counter(array(
    	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
    	));
    	?>
    	</p>

    <div class="paging">
    	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'btn btn-default'));?>
     | 	<?php echo $this->Paginator->numbers();?>
    	<?php echo $this->Paginator->next(__('siguiente').' >>', array(), null, array('class'=>'btn btn-default'));?>
    </div>
</div>