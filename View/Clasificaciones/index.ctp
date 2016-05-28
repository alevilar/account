<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Clasificación'));?>

<div class="content-white row">
	<?php
	echo $this->Html->link('Nueva Clasificación', array('action' => 'add_edit'), array(
	    'data-role'=>'button',
	    'data-theme' => 'b',
	    'class'=>'btn btn-success btn-lg btn-add pull-right',
	    )
	        );
	?>

	<h2>Listado de Clasificaciones</h2>
	<br>
	<div class="col-sm-4 col-sm-offset-4">

		<?php foreach ($clasificaciones as $id=>$c) { ?>

		    <div class="row">

		    	<div class="col-sm-6"><?php echo $c ?></div>

		    	<div class="col-sm-6">
			    	<!-- Split button -->
					<div class="btn-group">


						<?php echo $this->Html->link(__('Editar', true), array('action'=>'add_edit', $id), array('class'=>'btn btn-default btn-sm btn-edit')); ?>


					  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="caret"></span>
					    <span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu">


					    <li class="">
					    	<?php echo $this->Form->postLink( __('Borrar'), array('action'=>'delete', $id), array('class'=>' btn-sm'), __('¿Está seguro que desea eliminar: %s?', $c)); ?>
				    	</li>
					  </ul>
					</div>
				</div>
			</div>
	    <?php }	?>

	<div>

	<br>
</div>