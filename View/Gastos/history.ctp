<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Gasto', 'size'=>'modal-lg'));?>
<?php echo $this->element('Risto.image-modal-zoom');?>


<?php echo $this->Html->css('/account/css/style');?>

<div class="content-white">
<div class="btn-group pull-right">
<?php echo $this->Html->link('Nuevo Gasto', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'add'), array('class' => 'btn btn-lg btn-success btn-add')) ?>
</div>

<h1>Listado de Gastos</h1>


<?php echo $this->element('form_mini_year_month_search'); ?>

<?php echo $this->Form->create('Cierre', array('url'=>array('controller'=>'cierres', 'action'=>'add'))); ?>



<div class="btn-group btn-group-sm" role="group">
<?php
echo $this->Form->button('<span class="glyphicon glyphicon-folder-close"></span> '.__('Aplicar Cierre')
    , array(
    'escape' => false,
    'type' => 'button',
    'data-theme' => 'b',
    'data-inline' => 'true',
    'data-role' => 'button',
    'class' => 'btn btn-default',
    'div' => false,
    'id' => 'btn-gastos-apli-cierre'));


echo $this->Html->link('<span class="glyphicon glyphicon-download-alt"></span> '.__('Descargar Excel')
    , array(        
        $this->action,
        'ext'=> 'xls',
        '?' => trim(strstr($_SERVER['REQUEST_URI'], '?'), '?')
        )
    , array(
        'escape' => false,
        'data-ajax' => 'false',
        'class' => 'btn btn-default',
        'div'=> false
    ));

?>


</div>

<div id='place-for-inputs' class="cq-hide"></div>
<div id='descripcion-cierre' class="well cq-hide">
    <div class="pull-right">
        <span class="glyphicon glyphicon-info-sign"></span>
        <small><cite>Al cerrar un conjunto de gastos se impide que estos sean modificados.</cite></small>
    </div>
    <p><span class='detalle-gastos'></span> gastos seleccionados</p>
    <?php
    echo $this->Form->input('name', array('placeholder'=>'Ejemplo: Cierre de Abril','label' => 'breve descripción del cierre', 'required' => true));
    echo $this->Form->button('Cancelar', array('type' => 'button', 'id'=>'CancelBtn', 'class'=>'btn'));
    echo "&nbsp;";
    echo $this->Form->button('Guardar', array('type' => 'submit', 'class'=>'btn btn-primary'));
    
    ?>
</div>

<?php  echo $this->Form->end(); ?>


<br>

<?php echo $this->element('gastos_full_table'); ?>

</div>

<script type="text/javascript">
    $('#CancelBtn').bind('click', function() {
        $("#descripcion-cierre").hide("fade")
    });

</script>