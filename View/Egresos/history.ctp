
<?php echo $this->element('Risto.image-modal-zoom');?>

<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Pago'));?>


<div class="content-white">
<h1>Listado de Pagos</h1>

<?php
echo $this->Html->css('/account/css/style');
echo $this->element('egresos_search');

$urlTex = '';
foreach ($this->params['url'] as $u => $v) {
    if ($u != 'ext' && $u != 'url' && $u != 'page') {
        if (!empty($v)) {
            $urlTex .= "$u=$v&";
        }
    }
}
$urlTex = trim($urlTex, '&');
$this->Paginator->options(array('url' => array('?' => $urlTex)));


echo $this->element("Account.egresos_table_list");
?>



		<p>
    	<?php
    	echo $this->Paginator->counter(array(
    	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
    	));
    	?>
    	</p>

    <div class="paging">
    	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'btn btn-default'));?>
     | 	<?php echo $this->Paginator->numbers();?>
    	<?php echo $this->Paginator->next(__('siguiente').' >>', array(), null, array('class'=>'btn btn-default'));?>
    </div>
</div>