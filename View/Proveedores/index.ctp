
<div class="proveedores index">

<?php echo $this->Html->link(__('Nuevo Proveedor'), array('action' => 'add'), array('class'=>'btn btn-lg btn-success pull-right')); ?>

<h1><?php echo __('Proveedores');?></h1>



<br>
<div class="row">
<?php
echo $this->Form->create('Proveedor');
echo $this->Form->input('buscar_proveedor', array('type'=>'text', 'div'=>array('class'=>'col-md-6'), 'placeholder'=>'Buscar Proveedor', 'label'=>false));
echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary col-md-1'));
echo $this->Form->end();
?>
</div>

<div class="clearfix"></div>


<br>
<p>
<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('name',__('Nombre'));?></th>
	<th><?php echo $this->Paginator->sort('cuit',__('CUIT'));?></th>
	<th><?php echo $this->Paginator->sort('mail',__('Correo Electrónico'));?></th>
	<th><?php echo $this->Paginator->sort('telefono',__('Teléfono'));?></th>
	<th><?php echo $this->Paginator->sort('domicilio',__('Domicilio'));?></th>
	<th><?php echo $this->Paginator->sort('created',__('Creado'));?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($proveedores as $proveedor):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $proveedor['Proveedor']['name']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['cuit']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['mail']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['telefono']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['domicilio']; ?>
		</td>
		<td>
			<?php echo date("d/m/Y H:i", strtotime($proveedor['Proveedor']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $proveedor['Proveedor']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Borrar'), array('action' => 'delete', $proveedor['Proveedor']['id']), array('class'=>'btn btn-default'), null, sprintf(__('¿Esta seguro que desea eliminar "%s"?'), $proveedor['Proveedor']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
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
