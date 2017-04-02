<?php echo $this->element('Risto.image-modal-zoom');?>

<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Gasto', 'size'=>'modal-lg'));?>


<?php echo $this->Html->css('/account/css/style') ?>

<div class="content-white">
<div>

     <?php echo $this->Html->link('Nuevo Gasto', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'add'), array('class' => 'btn btn-lg btn-success pull-right btn-add')) ?>
    <h1>Pendientes de Pago</h1>


</div>
<hr>

    <div class="pull-right">
        <?php echo $this->Form->create('Gasto'); ?>
        <?php echo $this->Form->input('proveedor_id', array('onchange' => 'this.form.submit();', 'empty' => 'Filtrar por Proveedor', 'label' => false)) ?>
        <?php echo $this->Form->end() ?>
    </div>

<?php echo $this->Form->create('Egreso',array('url' => array('controller' => 'egresos', 'action' => 'add') ) ); ?>

<div class="row">


    <div class="col-md-2">
        
        <input id="selectall" type="checkbox" data-role="none"/>
        <label for="selectall">Seleccionar Todos</label>
    </div>

    <div class="col-md-2">
        <div id='ver-btn-crear-pago' style="display: none">
        <?php
        echo $this->Form->submit('Pagar', array('disabled' => (count($gastos) == 0), 'class' => 'btn btn-md btn-primary', 'id' => 'btn-crear-pago'));
        ?>
        </div>
        <br>
        
    </div>
</div>


<div class="row">

<?php 
if (empty($gastos)) {
    ?>
    <div class="alert alert-success"><?php echo __('No hay gastos pendientes de pago') ?></div>
    <?php
}
 ?>

    <table class="table table-hover table-responsive table-condensed list-con-imagen">

        <tbody>
            <?php
            $i = -1;
            foreach ($gastos as $gasto):
                $i++;
                ?>
                <tr class="list-item-con-imagen">
                    <td>
                        <?php
                        echo $this->Form->checkbox("Gasto.$i.gasto_seleccionado", array(
                            'value' => $gasto['Gasto']['id'],
                            'type' => 'checkbox',
                            'data-mini' => true,
                            'label' => false,
                            'class' => 'pull-left',
                        ));
                        ?>
                    </td>
                    
                    <td>
                        <?php echo date("d/m/Y", strtotime($gasto['Gasto']['fecha'])) ?>
                    </td>
                    
                     
                    <td>
                        <?php
                        if ($gasto['Gasto']['importe_pagado']) {
                            echo "<span style='text-decoration: line-through'>$" . $gasto['Gasto']['importe_total'] . "</span>";
                            echo " $" . ($gasto['Gasto']['importe_total'] - $gasto['Gasto']['importe_pagado']);
                        } else {
                            echo "$" . $gasto['Gasto']['importe_total'];
                        }
                        ?> 
                    </td>


                    <td>
                        <small><?php echo $gasto['TipoFactura']['name']; ?></small>
                    </td>
                    
                    <td>
                            <small><?php echo $this->Html->link($gasto['Proveedor']['name'], array('controller' => 'proveedores', 'action' => 'view', $gasto['Proveedor']['id']), array('data-rel' => 'dialog')); ?></small>
                    </td>

                    <td class="center image">
                        <?php echo $this->Html->mediaLink( $gasto['Media'], array('width'=>'48', 'img-modal'=>true) );?>                       
                    </td>
                    
                    
                     <td>
                        <?php echo $gasto['Gasto']['observacion']; ?>
                    </td>
                   
                    
                    <td>
                        <?php echo $gasto['Clasificacion']['name']; ?>
                    </td>

                   
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <?php
                                    echo $this->Html->link(__('Pagar'), array(
                                        'controller' => 'egresos',
                                        'action' => 'add', $gasto['Gasto']['id']), array(
                                        'data-ajax' => 'false',
                                        'class' => 'btn-edit'
                                    ));
                                    ?>
                                </li>

                                <li>
                                    <?php
                                    echo $this->Html->link(__('Ver'), array(
                                        'action' => 'view', $gasto['Gasto']['id']), array(
                                        'data-ajax' => 'false',
                                    ));
                                    ?>
                                </li>

                                <li>
                                    <?php
                                    echo $this->Html->link(__('Editar'), array(
                                        'action' => 'edit', $gasto['Gasto']['id']), array(
                                        'data-ajax' => 'false',
                                        'class' => 'btn-edit',
                                    ));
                                    ?>
                                </li>

                                <li>
                                    <?php
                                    echo $this->Html->link(__('Borrar'), array('action' => 'delete', $gasto['Gasto']['id']), array('class' => 'ajaxlink'), __('Seguro queres borrar el # %s?', $gasto['Gasto']['id']));
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>        
        </tbody>
    </table>

</div>
<?php
echo $this->Form->end();
?>

</div>


<?php $this->start('script');?>
<script>
    (function($) {
        var $inputs = $('input[type="checkbox"]', '#EgresoAddForm');
        $('#selectall').bind('change', function(e) {
            $inputs.each(function(k, i) {
                i.checked = e.currentTarget.checked;
            });
        });

        var $btnSubmit = $("#ver-btn-crear-pago");
        $inputs.bind('change', function(){
            if ( $('input[type="checkbox"]:checked', '#EgresoAddForm').length ) {
                $btnSubmit.show();
            } else {
                $btnSubmit.hide();
            }
        });
        

        $("#EgresoAddForm").on('submit', function(e){

            e.preventDefault();

            var url = $("#EgresoAddForm").attr('action');

            var datastring = $("#EgresoAddForm").serialize();
            $('#editModal').modal('show');
            
            

            $.post( url, datastring,function( data ) {
              $(".modal-body", '#editModal').html(data);
            });
            return false;
        });
    })(jQuery);

</script>

<?php $this->end();?>