<?php if (count($tipo_impuestos) == 0 ) { ?>
	

<?php } else { ?>

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
                            || !empty((float)$this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'])
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
       
    </div>
</div>

<?php } // endif?>