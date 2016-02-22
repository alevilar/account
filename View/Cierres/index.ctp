<h1>Listado de Cierres</h1>

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
                <?php echo $this->Html->link( 'Editar', array('action'=>'edit', $c['Cierre']['id']), array('class'=>'btn btn-sm btn-default') );?>
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
