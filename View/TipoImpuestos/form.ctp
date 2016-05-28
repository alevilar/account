<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Clasificacion'));?>

<div class="tipoImpuestos form">
<?php echo $this->Form->create('TipoImpuesto');?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>'Nombre'));
		echo $this->Form->input('porcentaje', array('label'=>'Porcentaje del Impuesto', 'placeholder'=>'Valores del 0 al 100, Ej: 10.5'));
        echo $this->Form->input('tiene_neto', array('type'=>'checkbox')); 
        echo $this->Form->input('tiene_impuesto', array('type'=>'checkbox')); 
	?>
<?php echo $this->Form->end('Submit');?>
</div>
