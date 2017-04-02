<div class="content-white">
    <?php
    if ( !empty($this->request->data['Egreso']['id'])) {
        $txt = 'Editar';
    } else {
        $txt = 'Crear Nuevo';
    }
    ?>
    <h1><?php echo $txt; ?> Pago
        <?php if (!empty($cant_gastos)) {
            if ( $cant_gastos > 1) { 
        ?>
            <small>Total adeudado que suman los <?php echo $cant_gastos ?> gastos seleccionados: <?php echo $this->Number->currency($this->request->data['Egreso']['total']) ?></small>
        <?php } else { ?>
            <small>Total adeudado que suma el gasto seleccionado: <?php echo $this->Number->currency($this->request->data['Egreso']['total']) ?></small>
            <?php }  
        }
        ?>
    </h1>

<?php
 echo $this->Form->create('Egreso', array('url' => array('action'=>'save'), 'data-ajax' => "false", 'type' => 'file'));
?>

    <div class="row">
        <div class="col-md-6">
    <?php
   
    echo $this->Form->input('id');
    echo $this->Form->hidden('redirect');


    echo $this->Form->input('fecha', array('type' => 'datetime'));


    echo $this->Form->input('tipo_de_pago_id');

    $disabled = true;
    $after = '<span class="text-danger">No se puede editar el importe de un pago</span>';
    if ( empty( $this->request->data['Egreso']['id'] ) ) {
        $disabled = false;
        $after = '<span class="text-info">¡Cuidado! Una vez guardado el pago no podrá modificar el importe total</span>';
    }
    echo $this->Form->input('total', array('type' => 'text', 'step'=>'any', 'disabled' => $disabled, 'after'=>$after));

    ?> 
        </div>


        <div class="col-md-6">
            
            <?php

        if (!empty($this->request->data['Egreso']['media_id'])) {    
                echo $this->Html->imageMedia( $this->request->data['Egreso']['media_id'] , array('class'=>'thumb'));
        }
        echo $this->Form->input('media_file',array('label'=>'PDF, Imagen, Archivo', 'type'=>'file'));


        echo $this->Form->input('observacion');
        ?>
        </div>
    </div>       
    

    <div style='display:none'>
    <?php
    // listado de gastos seleccionados ocultos

    echo "";
    foreach ($gastos as $gId => $g) {
        echo $this->Form->checkbox('Gasto.Gasto.' . $gId, array('checked' => true, 'value' => $gId));
    }
    ?>

    </div>

    <?php
    echo $this->Form->end(array('class'=>'btn btn-lg btn-success', 'label' => 'Guardar'));
    ?>
    <br>
    <?php
        if (isset($arqueoId) ) {
         echo $this->Html->link(__('Volver a la lista de pagos del arqueo'), array('plugin' => 'cash', 'controller' => 'arqueos', 'action' => 'listar_pagos', $arqueoId), array('class'=>'btn btn-info'));
         } else {
            $arqueoId = null;
         }

    ?>
</div>