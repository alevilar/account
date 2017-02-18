<?php 
echo $this->Html->script('/risto/lib/bootstrap.typehead/bootstrap3-typeahead', true);
?>

<div class="gastos form content-white">
    <?php echo $this->Form->create('Gasto', array( 'type' => 'file', 'id'=>'GastoAddForm')); ?>
    <?php echo $this->Form->hidden('id'); ?>
    <?php echo $this->Form->hidden('pagar', array('value' => true)); ?>
    <div class="row">

        <div class="col-md-4">
            <?php
            echo $this->Form->input('fecha', array('type' => 'date'));
            
            echo $this->Form->hidden('proveedor_id');

            echo $this->Form->input('proveedor_list', array(
                'autocomplete'=>'off',
                'label' => 'Proveedor', 
                'type' => 'text', 
                'id' => 'proveedores', 
                'required' => false,
                'class' => 'form-control auto-complete',
                'data-url' => $this->html->url(array('plugin' => 'account', 'controller' => 'proveedores', 'action' => 'index', 'ext' => 'json')),
                'data-toggle' => 'popover',
                'after' => '<div style="display:none" class="text-warning" id="nuevo-proveedor">Se va a creear un nuevo proveedor</div>',
                )
                    );

            echo $this->Form->input('tipo_factura_id');
            echo $this->Form->input('factura_nro', array('required' => false));
            
            echo $this->Form->input('media_file',array('label'=>'PDF, Imagen, Archivo', 'type'=>'file'));                    
            
            echo $this->Form->input('clasificacion_id', array('empty' => '- Seleccione -'));
            echo $this->Form->input('observacion');
            ?>
        </div>
        <div class="col-md-8">

            <div class="well">
                <div class="row">
                    <h4>Seleccionar los impuestos aplicados en esta factura</h4>
                    <div class="col-md-12">
                        <div id="impuestos-check">
                            <?php
                            foreach ($tipo_impuestos as $ti) {
                                ?>

                                <div class="row">
                                    <div class="col-md-4">
                                    <?php
                                    echo $this->Form->checkbox('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.checked', array(
                                       // 'type' => 'checkbox',
                                        'class' => 'text-info',
                                        'label' => false,
                                        'style' => 'width: 16px; height: 16px;',
                                       // 'div' => array('class' => 'form-group checkbox-inline'),
                                        'checked' => !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]),
                                        'onchange' => 'if(this.checked){jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").show()} else {jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").hide()}'
                                    ));
                                    echo " ".$ti['TipoImpuesto']['name'];

                                    $ocultar = empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]);
                                    ?>
                                    </div>
                                    <div class="col-md-8">
                                        <div  class="row detalle-impuesto" <?php echo ($ocultar) ? 'style="display: none;"' : ''; ?> id="<?php echo 'tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] ?>">
                                   
                                            <div class="col-md-6">
                                            <?php
                                            if ( $ti['TipoImpuesto']['tiene_neto']
                                                || !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'])
                                                ) {
                                                echo $this->Form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . ".neto", array(
                                                    'type' => 'number',
                                                    'step'=>'any',
                                                    'placeholder' => "Neto",
                                                    'label' => false,
                                                    'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                                    'class' => 'calc_neto importe',      
                                                    'div' => array('class' => 'form-group'),
                                                    'value' => !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'] : '',
                                                ));
                                            }
                                            ?>
                                                </div>
                                            
                                            <div class="col-md-6">
                                            <?php

                                             if ( $ti['TipoImpuesto']['tiene_impuesto'] 
                                                || !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'])
                                                ) {
                                                echo $this->Form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.importe', array(
                                                    'type' => 'number',
                                                    'step'=>'any',
                                                    'placeholder' => 'Impuesto',
                                                    'label' => false,
                                                    'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                                    'class' => 'calc_impuesto importe',
                                                    'div' => array('class' => 'form-group'),                               
                                                    'value' => !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'] : '',
                                                ));
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php


                            }
                            ?>
                            <div class="clear"></div>
                        </div>


                    </div>

                    <div class="col-md-8">

                        <div class="row" id="impuestos">
                            <?php
                            foreach ($tipo_impuestos as $ti) {
                                
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo $this->Form->input('importe_neto', array('id' => 'importe-neto', 'type' => 'number', 'step'=>'any'));
            echo $this->Form->input('importe_total', array('id' => 'importe-total', 'type' => 'number', 'step'=>'any'));
            ?>


      
                
             <div>
                <?php echo $this->Form->button('Guardar Sin Pagar', array('data-theme' => 'b', 'id' => 'btn-guardar-sin-pagar', 'class' => 'btn btn-lg')); ?>

                <?php echo $this->Form->button('Pagar', array('data-theme' => 'e', 'id' => 'btn-guardar-y-pagar', 'class' => 'pull-right btn btn-lg btn-primary')); ?>            
            </div>


        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>

<?php echo $this->Html->script('/account/js/gastos_add', true); ?>
