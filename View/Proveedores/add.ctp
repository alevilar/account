
<div class="proveedores form">
<?php echo $this->Form->create('Proveedor');?>
	<fieldset>
 		<legend><?php __('Nuevo Proveedor');?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>'Nombre'));
		echo $this->Form->input('cuit');
		echo $this->Form->input('mail');
		echo $this->Form->input('telefono');
		echo $this->Form->input('domicilio');
		echo $this->Form->input('Rubro');
	?>
        <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>        </fieldset>
</fieldset>

</div>
