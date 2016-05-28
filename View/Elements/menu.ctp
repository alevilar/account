<ul class="nav nav-tabs  nav-justified">


    <?php $class = ($this->request->action == 'index' && $this->request->controller == 'gastos' ) ? 'active':'';?>
    <li class="<?php echo $class ?>">
        <?php echo $this->Html->link('Pendientes de Pago', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'index')) ?>
    </li>

    <?php $class = ($this->request->action == 'history' && $this->request->controller == 'gastos' ) ? 'active':'';?>
    <li class="<?php echo $class ?>">
        <?php echo $this->Html->link('Listado de Gastos', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'history')) ?>
    </li>
   


    <?php $class = ($this->request->controller == 'egresos' ) ? 'active':'';?>
    <li class="<?php echo $class ?>">
        <?php echo $this->Html->link('Listado de Pagos', array('plugin'=>'account', 'controller'=>'egresos', 'action'=>'history')) ?>
    </li>

    <?php $class = ($this->request->controller == 'cierres' ) ? 'active':'';?>
    <li class="<?php echo $class ?>">
        <?php echo $this->Html->link('Cierres', array('plugin'=>'account', 'controller'=>'cierres', 'action'=>'index')) ?>
    </li>

   

</ul>