<div class="tipoImpuestos index">
	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Crear Tipo de impuesto'), array('action' => 'add'), array('class'=>'btn btn-success btn-lg')); ?>
	</div>
<h2><?php echo  __('Tipo de Impuestos');?></h2>
<p>
<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('name',__('Nombre'));?></th>
	<th><?php echo $this->Paginator->sort('porcentaje',__('Porcentaje'));?></th>
        <th><?php echo $this->Paginator->sort('tiene_neto',__('Neto'));?></th>
        <th><?php echo $this->Paginator->sort('tiene_impuesto');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($tipoImpuestos as $tipoImpuesto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $tipoImpuesto['TipoImpuesto']['name']; ?>
		</td>
		<td>
			<?php echo $tipoImpuesto['TipoImpuesto']['porcentaje']; ?>
		</td>
                <td>
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_neto']; ?>
		</td>
                <td>
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_impuesto']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $tipoImpuesto['TipoImpuesto']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar'), array('action' => 'delete', $tipoImpuesto['TipoImpuesto']['id']), null, sprintf(__('¿Esta seguro que desea eliminar el tipo de impuesto "%s"?'), $tipoImpuesto['TipoImpuesto']['name'])); ?>
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
