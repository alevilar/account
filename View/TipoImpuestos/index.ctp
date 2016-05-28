<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Tipo de Impuesto'));?>


<div class="tipoImpuestos index content-white">
	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Crear Tipo de impuesto'), array('action' => 'add'), array('class'=>'btn btn-success btn-lg btn-add')); ?>
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
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_neto']?'✓':''; ?>
		</td>
        <td>
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_impuesto']?'✓':''; ?>
		</td>
		<td class="actions">
		
			<!-- Split button -->
			<div class="btn-group">


				<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $tipoImpuesto['TipoImpuesto']['id']), array('class'=>'btn btn-default btn-sm btn-edit')); ?>


			  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu">



			    <li class="">
			    	<?php echo $this->Form->postLink( __('Borrar'), array('action'=>'delete', $tipoImpuesto['TipoImpuesto']['id']), array('class'=>' btn-sm'), __('¿Está seguro que desea eliminar: %s?', $tipoImpuesto['TipoImpuesto']['name'])); ?>
		    	</li>
			  </ul>
			</div>

		</td>
	</tr>
<?php endforeach; ?>
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
