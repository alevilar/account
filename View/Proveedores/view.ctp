<?php $this->element('Risto.layout_modal_edit'); ?>
<div class="content-white">
<h2><?php echo  __('Proveedor %s', $proveedor['Proveedor']['name'] );?></h2>
<div class="row">
<dl>
<?php $i = 0; $class = '';?>
<div class="col-sm-2 col-md-2 col-xs-2">
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cuit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['cuit']; ?>
			&nbsp;
		</dd>
</div>
<div class="col-sm-2 col-md-2 col-xs-2">
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Mail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['mail']; ?>
			&nbsp;
		</dd>
</div>
<div class="col-sm-2 col-md-2 col-xs-2">
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Telefono'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['telefono']; ?>
			&nbsp;
		</dd>
</div>
<div class="col-sm-2 col-md-2 col-xs-2">
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Domicilio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['domicilio']; ?>
			&nbsp;
		</dd>
</div>	
<div class="col-sm-2 col-md-2 col-xs-2">
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Rubros'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
<?php 
foreach($proveedor['Rubro'] as $rubro) {
echo $rubro['name']. ", "; 
}
?>
			&nbsp;
		</dd>
</div>
<div class="col-sm-2 col-md-2 col-xs-2">
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Tipo Impuestos'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
<?php
foreach($proveedor['TipoImpuesto'] as $TI) {
echo $TI['name']. ", "; 
}
?>
			&nbsp;
		</dd>
</div>	
	</dl>
</div>

<div class="btn-group">
		<?php echo $this->Html->link(__('Editar Proveedor'), array('action' => 'edit', $proveedor['Proveedor']['id']), array('class'=>'btn btn-default btn-edit')); ?>
		<?php echo $this->Html->link(__('Volver a Lista de Proveedores'), array('action' => 'index'), array('class'=>'btn btn-default')); ?>
		<?php echo $this->Html->link(__('Nuevo Proveedor'), array('action' => 'add'), array('class'=>'btn btn-default btn-add')); ?>

		<?php echo $this->Html->link(__('Borrar Proveedor'), array('action' => 'delete', $proveedor['Proveedor']['id']), array('class'=>'btn btn-danger'), sprintf(__('Are you sure you want to delete # %s?', true), $proveedor['Proveedor']['id'])); ?>
</div>

<center><h1>Tabla historica de pedidos al proveedor</h1></center>

<div class="paging paginationxt text-center">
		<br>
		<?php echo $this->element('Users.paging'); ?>
		<br>
		<?php echo $this->element('Risto.pagination'); ?>
		<br><br>
	</div>

<p>Haga click en el número de orden para ver el pedido seleccionado.</p>
	<table class="table table-condensed">
	   	 

		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('id', "#Orden")?></th>
				<th><?php echo $this->Paginator->sort('created', "Fecha")?></th>
				<th><?php echo $this->Paginator->sort('created_by', "Creador del pedido")?></th>
				<th><?php echo $this->Paginator->sort('cantidad', "Cantidad")?></th>
				<th><?php echo $this->Paginator->sort('unidad_de_medida_id', "U/Medida")?></th>
				<th><?php if (!isset($esInformativa)) { echo $this->Paginator->sort('name', "Mercaderia"); }?></th>
				<th><?php echo $this->Paginator->sort('precio', "Precio")?></th>
				<th>Rubro</th>
			</tr>	
		</thead>
		
		<tbody>
	<?php foreach ($pedidos[0]['Pedido'] as $mercaderia) { ?>
		<tr>
			<?php
			$id_pedido = $mercaderia['id'];
			$fecha_creacion = $this->Time->nice($mercaderia['created']);
			$username = $mercaderia['User']['username'];
foreach($mercaderia['PedidoMercaderia'] as $merca) {
            $mercaderia = $merca['Mercaderia']['name']; 
            $cantidad = $merca['cantidad'];          
            $precio = $merca['precio'];
            $unidadDeMedida = $merca['Mercaderia']['UnidadDeMedida']['name'];
            $rubro = $merca['Mercaderia']['Rubro']['name'];
}
			?>

			<td><?php 
			if ($id_pedido){
				echo $this->Html->link("#".$id_pedido, array('plugin' => 'compras', 'controller'=>'pedidos', 'action'=>'view', $id_pedido),array('target'=>'_blank'));
			}
				?></td>
			<td class="small"><?php echo $fecha_creacion;?></td>
			<td><?php echo $username;?></td>
			<td><?php echo $cantidad;?></td>
			<td><?php echo $unidadDeMedida;?></td>
			<td><?php echo $mercaderia;?></td>
			<td><?php echo $precio;?></td>
			<td><?php echo $rubro;?></td>
		</tr>
	<?php } ?>
		</tbody>
	</table>

</div>