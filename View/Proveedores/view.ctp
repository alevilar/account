<?php $this->element('Risto.layout_modal_edit'); ?>
<div class="content-white">
<h1 class="center"><?php echo __("Detalles del Proveedor") ?></h1>

<div class="row">
<div class="col-sm-12 col-md-12">
<h3 class="grey pull-right"><?php echo __("CUIT: %s",!empty($proveedor['Proveedor']['cuit'])? $proveedor['Proveedor']['cuit'] : '-') ?> </h3>
<h2><?php echo  $proveedor['Proveedor']['name'];?></h2>
</div>
</div>

<div class="btn-group">
		<?php echo $this->Html->link(__('Editar Proveedor'), array('action' => 'edit', $proveedor['Proveedor']['id']), array('class'=>'btn btn-default btn-edit')); ?>
		<?php echo $this->Html->link(__('Nuevo Proveedor'), array('action' => 'add'), array('class'=>'btn btn-default btn-add')); ?>

		<?php echo $this->Html->link(__('Borrar Proveedor'), array('action' => 'delete', $proveedor['Proveedor']['id']), array('class'=>'btn btn-danger'), sprintf(__('Are you sure you want to delete # %s?', true), $proveedor['Proveedor']['id'])); ?>
</div>
<br><br>
<table class="table">

<?php $i = 0; $class = '';?>
<tr>
		<td><?php if ($i % 2 == 0) echo $class;?><?php echo __('<b>Mail:</b>'); ?>
		<?php echo !empty($proveedor['Proveedor']['mail'])? $proveedor['Proveedor']['mail'] : '-'; ?></td>
</tr>		
<tr>
		<td><?php if ($i % 2 == 0) echo $class;?><?php echo __('<b>Telefono:</b>'); ?>
		<?php echo !empty($proveedor['Proveedor']['telefono'])? $proveedor['Proveedor']['telefono'] : '-'; ?></td>
</tr>
<tr>
		<td><?php if ($i % 2 == 0) echo $class;?><?php echo __('<b>Domicilio:</b>'); ?>
		<?php echo !empty($proveedor['Proveedor']['domicilio'])? $proveedor['Proveedor']['domicilio'] : '-'; ?></td>
</tr>
<tr>
		<td><?php if ($i % 2 == 0) echo $class;?><?php echo __('<b>Rubros:</b>'); ?>
<?php 
if(empty($proveedor['Rubro'])) {
		echo "-";
}
foreach($proveedor['Rubro'] as $rubro) {
	echo $rubro['name'].", ";
}
?>
</td>
</tr>
<tr>
		<td><?php if ($i % 2 == 0) echo $class;?><?php echo __('<b>Tipo Impuestos:</b>'); ?>
<?php
if(empty($proveedor['TipoImpuesto'])) {
		echo "-";
}
foreach($proveedor['TipoImpuesto'] as $TI) {
	echo $TI['name'].", ";
}
?>
</td>
</tr>
</table>

<center><h1>Tabla historica de pedidos al proveedor</h1></center>

	<?php echo $this->element('Compras.pedido_mercaderia_list', array('notShow' => 
	                                                                  array('proveedor_name',
                                                                            'actions'
	                                                                  ))); ?>


<center><?php echo $this->Html->link(__('Volver a Lista de Proveedores'), array('action' => 'index')); ?></center>

</div>