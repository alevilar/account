<?php $this->append('paxapos-main-menu');?>
    <?php echo $this->element("Risto.paxapos_main_menu/tenant_home_btn");?>
    <br>
    <?php echo $this->element("Account.paxapos_context_menu");?>
<?php $this->end();?>



<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Gasto', 'size'=>'modal-lg'));?>



<div class="content-white">
<?php echo $this->Html->css('/account/css/style'); ?>



<div class="row">
    <div class="col-sm-12 center">
        <?php  echo $this->Html->link('<i class="fa fa-arrow-left"></i> Volver al Listado de Pagos', array(
                    'action' => 'history'
                    ),
                    array(
                        'class' => 'btn btn-default',
                        'escape' => false,
                    )
        );?>
    </div>
    <div class="col-sm-3">
        <h1 class="black-5">Pago #<?php echo $egreso['Egreso']['id']?></h1>
    </div>
    <div class="col-sm-1 center">
        <?php echo $this->Html->imageMedia($egreso['TipoDePago']['media_id'], array('class'=>'image-responsive', 'width'=>'64')) ?>
    </div>
    <div class="col-sm-4 center">
        <h1 class='total text-success'><?php echo $this->Number->currency($egreso['Egreso']['total']); ?></h1>
    </div>
    <div class="col-sm-2 center">
        <p style="margin-top:30px" class="black-8 fecha"><b>
            Fecha y Hora:<br><?php echo date('d-m-y H:i', strtotime($egreso['Egreso']['fecha'])) ?></b></p>
    </div>

    <div class="col-sm-2 center">
        <p style="margin-top:30px" class="black-8">
    <?php echo $this->Html->link('  Editar pago',array('action' => 'edit', $egreso['Egreso']['id']), array('class'=>'btn btn-primary btn-edit')); ?>
        <br><br>
     <?php echo $this->Html->link('Eliminar pago', array('action'=>'delete', $egreso['Egreso']['id']), array('class'=>'text-danger'), __('¿Está seguro que desea borrar el pago $%s', 
     $egreso['Egreso']['total'])) ?>
    </p>
    </div>
</div>



<div class="pagos-list">
    <p><?php


if ( $egreso['Egreso']['media_id'] ) {
    $img = $this->Html->imageMedia( $egreso['Egreso']['media_id'], array('width'=>'100px') );
    echo $this->Html->link($img, array('plugin'=>'risto', 'controller'=>'medias', 'action'=>'view', $egreso['Egreso']['media_id'] ), array( 'escape' => false ));
}


if (!empty($egreso['Egreso']['observacion'])) {
    echo "<span class='observacion'> " . $egreso['Egreso']['observacion'] . "</span>";
}
?></p>
    
    
    <div>
        <h3>Listado de Gastos involucrados en este Pago</h3>

        <?php echo $this->element('gastos_full_table', array('mostrarEgresoInvolucrado' => true)); ?>
    </div>

</div>
</div>