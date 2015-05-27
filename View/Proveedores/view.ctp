
<div class="proveedores view">
<h2><?php echo  __('Proveedor %s', $proveedor['Proveedor']['name'] );?></h2>
	<dl><?php $i = 0; $class = '';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cuit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['cuit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Mail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['mail']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Telefono'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['telefono']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Domicilio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $proveedor['Proveedor']['domicilio']; ?>
			&nbsp;
		</dd>
		
	</dl>
</div>



<div class="btn-group">
		<?php echo $this->Html->link(__('Editar Proveedor'), array('action' => 'edit', $proveedor['Proveedor']['id']), array('class'=>'btn btn-default')); ?>
		<?php echo $this->Html->link(__('Listar Proveedores'), array('action' => 'index'), array('class'=>'btn btn-default')); ?>
		<?php echo $this->Html->link(__('Nuevo Proveedor'), array('action' => 'add'), array('class'=>'btn btn-default')); ?>

		<?php echo $this->Html->link(__('Borrar Proveedor'), array('action' => 'delete', $proveedor['Proveedor']['id']), array('class'=>'btn btn-danger'), sprintf(__('Are you sure you want to delete # %s?', true), $proveedor['Proveedor']['id'])); ?>
</div>
