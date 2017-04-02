
<br>
<?php echo $this->Html->link(
				'Nuevo Gasto', 
				array(
					'plugin'=>'account', 
					'controller'=>'gastos', 
					'action'=>'add'), 
				array(
					'class' => 'btn btn-lg btn-success btn-add btn-block',
					'onclick' => '$(".modal").modal("hide")'
				)
			);?>
<br>

<h4 class="blue center">Opciones de Configuración</h4>
<div class="list-group">

	    <?php echo $this->Html->link('Proveedores', array('plugin'=>'account', 'controller'=>'proveedores', 'action'=>'index'), array('class'=>'list-group-item')) ?>

	    <?php echo $this->Html->link('Impuestos', array('plugin'=>'account', 'controller'=>'tipo_impuestos', 'action'=>'index'), array('class'=>'list-group-item')) ?>

	    <?php echo $this->Html->link('Clasificaciones', array('plugin'=>'account', 'controller'=>'clasificaciones', 'action'=>'index'), array('class'=>'list-group-item')) ?>
</div>