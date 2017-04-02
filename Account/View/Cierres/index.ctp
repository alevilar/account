

<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Cierre'));?>

<div class="content-white">
    <h1>Listado de Cierres</h1>

    <?php if ( count($cierres) == 0 ) { ?>
        <p class="alert alert-info">Los cierres son un conjunto de gastos que "se cierran" para que no puedan ser modificados. Esto es especialmente útil cuando se envian las facturas al contador dejandolas cerradas, tanto como para identificarlas, como para no permitir modificaciones una vez que son presentadas.
        </p>

        <p class="alert alert-danger">Aún no hay cierres. Los cierres se realizan desde el listado de Gastos</p>
    <?php } else { ?>
    <table class="table px-cierres-list">
        <thead>
            <tr>
                <th>#ID</th>
                <th><?php echo __( 'Nombre' );?></th>
                <th><?php echo __( 'Fecha' );?></th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($cierres as $c) {
                ?>
                <tr>


                <td><?php echo $c['Cierre']['id']?></td>


                <td class="name">
                <?php
                echo $this->Html->link($c['Cierre']['name'], array('controller' => 'cierres', 'action' => 'view', $c['Cierre']['id']));
                ?>
                </td>


                <td class="fecha"><?php echo date('d-m-Y H:i', strtotime($c['Cierre']['created']));?></td>

                <td>
                <div class="btn-group">
                    <?php echo $this->Html->link( 'Editar', array('action'=>'edit', $c['Cierre']['id']), array('class'=>'btn btn-sm btn-default btn-edit') );?>
                    <?php echo $this->Html->link('Ver', array('controller' => 'cierres', 'action' => 'view', $c['Cierre']['id']), array('class'=>'btn btn-sm btn-default'));
                    ?>
                </div>
                </td>


                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php }?>
</div>