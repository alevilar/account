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

	<?php echo $this->element('Compras.pedido_mercaderia_list', array('notShow' => 
	                                                                  array('proveedor_name',
                                                                            'actions'
	                                                                  ))); ?>

</div>