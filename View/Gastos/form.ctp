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
                <div class="row" id="gastos-impuestos-container" data-url="<?php echo $this->Html->url(array('action'=>'impuestos_del_proveedor'))?>">
                    <?php echo $this->element('Account.impuestos_data');?>
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
