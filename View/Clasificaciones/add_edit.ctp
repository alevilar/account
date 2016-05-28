<?php
//debug($this);

echo $this->Form->create('Clasificacion', array('url'=>array('action'=>$this->action), $clasificacion_id));

echo $this->Form->input('id', array('value' => $clasificacion_id));
echo $this->Form->input('parent_id', array('options'=>$clasificaciones, 'empty'=>'Seleccionar'));
echo $this->Form->input('name');
echo $this->Form->submit('Guardar', array('class'=>'btn btn-primary pull-right'));
if (!empty($clasificacion_id)){
    echo $this->Html->link('- eliminar -', array('action'=>'delete', $clasificacion_id), array( 'class'=>'btn btn-danger btn-sm'), sprintf(__('¿Esta seguro que desea borrar?', true)));
}
echo $this->Form->end();

?>
<div class="clearfix"></div>
