
<?php echo $this->element('Risto.image-modal-zoom');?>
<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Gasto', 'size'=>'modal-lg'));?>



<div class="content-white">
<?php echo $this->Html->css('/account/css/style'); ?>



<div class="row">




    <div class="col-sm-12 col-xs-6 center">
        <?php  echo $this->Html->link('<i class="fa fa-arrow-left"></i> Volver al Listado de Pagos', array(
                    'action' => 'history'
                    ),
                    array(
                        'class' => 'btn btn-default',
                        'escape' => false,
                    )
        );?>
    </div>

    <div class="clearfix"></div>


    <div class="col-sm-2 col-xs-12">
        <?php
        echo $this->Html->mediaLink(  $egreso['Egreso']['media_id'], array(
                                        'width'=>'400', 
                                        'class'=>'img-responsive img-thumbnail',
                                        'img-modal' => true,
                                        ) 
                                    );
        ?>
       
    </div>


    <div class="col-xs-6 col-sm-4">
        <h1 class="black-8">Pago #<?php echo $egreso['Egreso']['id']?></h1>
         <p style="margin-top:30px" class="black-8 fecha">
            Fecha: <b><?php echo date('d-m-y', strtotime($egreso['Egreso']['fecha'])) ?></b>
            <br>
            Hora:&nbsp;&nbsp;&nbsp;<b><?php echo date('H:i', strtotime($egreso['Egreso']['fecha'])) ?></b>
        </p>
    </div>
   
    <div class="col-xs-6 col-sm-4 center">
        <h1 class='total text-success'><?php echo $this->Number->currency($egreso['Egreso']['total']); ?></h1>
        <?php echo $this->Html->imageMedia($egreso['TipoDePago']['media_id'], array('class'=>'image-responsive', 'width'=>'64')) ?>
       

        <?php
        if (!empty($egreso['Egreso']['observacion'])) {
            echo "<b>OBS: </b><span class='observacion'> " . $egreso['Egreso']['observacion'] . "</span>";
        }
        ?>
    </div>

    <div class="col-sm-2">
         <br>
        <?php 
        echo $this->Html->link('Editar', array('action'=>'edit', $egreso['Egreso']['id']), array('class'=>'btn btn-primary btn-edit btn-block '));
        ?>
        <br>
        <?php echo $this->Html->link('Borrar', array('action' => 'delete', $egreso['Egreso']['id']), array('class' => 'btn btn-danger  btn-block'), __('Seguro queres borrar el Pago # %s?', $egreso['Egreso']['id'])); ?>

    </div>
   
</div>



<div class="pagos-list">
     
    <div>
        <h3 class="black-5">Listado de Gastos involucrados en este Pago</h3>

        <?php echo $this->element('gastos_full_table', array('mostrarEgresoInvolucrado' => true)); ?>
    </div>

</div>
</div>