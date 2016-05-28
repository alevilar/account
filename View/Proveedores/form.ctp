
<div class="proveedores form">
<?php echo $this->Form->create('Proveedor');?>

<div class="row">

	<div class="col-sm-12">
		<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>'Nombre'));
		?>
	</div>

	<div class="col-sm-4">
		<?php
		echo $this->Form->input('cuit');
		
		?>
	</div>

	<div class="col-sm-4">
		<?php
		echo $this->Form->input('mail');
		
		?>
	</div>


	<div class="col-sm-4">
		<?php
		
		echo $this->Form->input('telefono');
		if ( $rubros ) {
			echo $this->Form->input('Rubro');
		}
		?>
	</div>

	<div class="col-sm-12">
		<?php
		echo $this->Form->input('domicilio');
		echo $this->Form->submit('Guardar', array('class'=>'btn btn-primary btn-block'));
		?>
	</div>
	
		
<?php echo $this->Form->end();?>
</div>
</div>
