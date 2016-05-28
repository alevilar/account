<?php $this->append('paxapos-main-menu');?>
    <?php echo $this->element("Risto.paxapos_main_menu/tenant_home_btn");?>
    <br>
    <?php echo $this->element("Account.paxapos_context_menu");?>
<?php $this->end();?>



<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Gasto', 'size'=>'modal-lg'));?>



<div class="content-white">
    <?php if ( !empty($gasto['Gasto']['cierre_id']) ) { ?>
        <p class="alert alert-warning">Este Gasto se encuentra cerrado.  
            <?php echo $this->Html->link($gasto['Cierre']['name'], array(
        'controller' => 'cierres',
        'action' => 'view',
        $gasto['Gasto']['cierre_id']
        ))?></p>
    <?php } ?>



    <?php 
    echo $this->Html->css('/account/css/style');
    $class = (abs($gasto['Gasto']['importe_pagado']) < abs($gasto['Gasto']['importe_total']))?'deuda':'pagado';
    ?>





<div class="row">
    <div class="col-sm-2">
        <?php echo $this->Html->mediaLink( $gasto['Media'], array('width'=>'200', 'class'=>'img-responsive img-thumbnail') );?>

        <div class="clearfix"></div>

        <br>
        <?php 
        $disabled =  $gasto['Gasto']['cierre_id']  ? 'disabled' : '';

        echo $this->Html->link('Editar', array('action'=>'edit', $gasto['Gasto']['id']), array('class'=>'btn btn-primary btn-edit btn-block '.$disabled));
        ?>
        <br>
        <?php echo $this->Html->link('Borrar', array('action' => 'delete', $gasto['Gasto']['id']), array('class' => 'btn btn-danger  btn-block'), __('Seguro queres borrar el # %s?', $gasto['Gasto']['id'])); ?>

    </div>

    <div class="col-sm-4">
        <div class="imagen-pagado <?php echo $class ?>">
            <?php echo ($class=='pagado')?$this->Html->image('pagado.png'):"" ?>
        </div>


        <h1>Gasto #<?php echo $gasto['Gasto']['id']?></h1>

        <h3><?php echo $gasto['TipoFactura']['name']; ?></h3>
        <p></p>

        <p>Importe Neto: <?php echo $this->Number->currency($gasto['Gasto']['importe_neto']) ?><br>
        <?php foreach ($gasto['Impuesto'] as $imp) { ?>
            <?php echo $imp['TipoImpuesto']['name'] ?>: 
            <?php echo $this->Number->currency($imp['importe']) ?><br>
            
        <?php } ?>
        </p>

        <p>Importe Total: <?php echo $this->Number->currency($gasto['Gasto']['importe_total']) ?></p>
        <p>Importe Pagado: <?php echo $this->Number->currency($gasto['Gasto']['importe_pagado']) ?></p>


        <p>
            <?php if (!empty($gasto['Proveedor']['name'])){ ?>
            Proveedor: <?php echo $gasto['Proveedor']['name']; ?><br>
            <?php } ?>

            <?php if ($gasto['Clasificacion']['name'] ) { ?>
                Clasificación: <?php echo $gasto['Clasificacion']['name']; ?><br>
            <?php } ?>
        </p>

        <?php
        if ( $gasto['Gasto']['importe_total'] - $gasto['Gasto']['importe_pagado'] ) {
            echo $this->Html->link(__('Pagar'), array(
                    'controller' => 'egresos',
                    'action' => 'add', 
                    $gasto['Gasto']['id']), 
                array(
                    'data-ajax' => 'false',
                    'class' => 'btn btn-lg btn-success btn-edit'
            ));
        }
       
        ?>
        <div class="clearfix"></div>

    </div>


    <div class="col-sm-6">
        

        <?php if (!empty($gasto['Egreso'])) { ?>
        <h3>Listado de Pagos</h3>
        <ul class="list-group">
        <?php foreach ($gasto['Egreso'] as $pags){ ?>    
            <li class="list-group-item">
                <span class="tipo_de_pago"><?php echo $this->Html->imageMedia($pags['TipoDePago']['media_id'], array('alt'=>$pags['TipoDePago']['name'], 'title'=>$pags['TipoDePago']['name'])); ?></span>
                <small>Fecha:</small> <?php echo date('d-m-y', strtotime($pags['fecha']))?>
                &nbsp;&nbsp;<small>Importe:</small> <?php echo $this->Number->currency($pags['AccountEgresosGasto']['importe'])?>
                <?php echo $this->Html->link('ir al pago', array('controller'=>'egresos', 'action'=>'view', $pags['id']), array('class'=>'btn btn-default')) ?>
                
                <?php echo $this->Html->imageMedia( $pags['media_id'], array('height'=>'40px')); ?>

                <?php echo $this->Html->link('X', array('controller'=>'egresos', 'action'=>'delete', $pags['AccountEgresosGasto']['egreso_id']),
                                    array('class'=>'btn btn-danger pull-right')
                                    , sprintf(__('¿Está seguro que desea borrar el pago %s'), $pags['TipoDePago']['name'])) ?>
                
            </li>
        <?php } ?>
        </ul>
        <?php } else {?>
            <p class="alert">No hay ningún Pago realizado para este gasto</p>
        <?php } ?>
            
    </div>
    </div>
</div>