<div class="content-white">
	<h1>Editando el Cierre #<?php echo $this->data['Cierre']['id']?></h1>


	<?php echo $this->Form->create('Cierre')?>

	<?php echo $this->Form->input('id')?>
	<?php echo $this->Form->input('name')?>


	<?php echo $this->Form->end('Guardar')?>
</div>