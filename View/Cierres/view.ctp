<?php //echo $this->Html->css('/account/css/style'); ?>

<h1>Viendo detalle del Cierre <small><cite>"<?php echo $cierre['Cierre']['name'] ?>"</cite></small></h1>

<?php echo $this->Html->link( 'Modificar Nombre del Cierre', array('action'=>'edit', $cierre['Cierre']['id']), array('class'=>'btn btn-lg btn-info pull-right') );?>


<p>
    creado: <?php echo date('d-m-Y H:i', strtotime($cierre['Cierre']['created'])); ?>
</p>

<h3>Listado de los Gastos que entraron en este cierre</h3>

<?php
echo $this->Html->link(' <span class="glyphicon glyphicon-download"></span> '.__('Descargar Excel')
    , array(                
        $cierre['Cierre']['id'],
        'ext'=> 'xls',
        '?' => trim(strstr($_SERVER['REQUEST_URI'], '?'), '?')
        )
    , array(
        'escape' => false,
        'data-ajax' => 'false',
        'class' => 'btn btn-primary pull-right',
        'div'=> array(
            'class' => 'pull-right'
            )
    ));

?>

<?php echo $this->element('gastos_full_table'); ?>