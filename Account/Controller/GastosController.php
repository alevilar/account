<?php

App::uses('AccountAppController', 'Account.Controller');

class GastosController extends AccountAppController
{

    public $name = 'Gastos';
    

  
    public function index()
    {
        $this->Prg->commonProcess('Gasto', array('paramType' => 'querystring'));
        $this->Prg->presetForm('Gasto');
        $conditions = $this->Gasto->parseCriteria( $this->Prg->parsedParams() );
        
        // $this->pageTitle = 'Gastos Pendientes de Pago';
        $this->Gasto->recursive = 1;
        $this->Gasto->order = array('Gasto.created ASC');
        $gastos = $this->Gasto->enDeuda($conditions);
        $gastos = $this->Gasto->completarConImportePagado($gastos);

        $proveedores = $this->Gasto->Proveedor->find('list');
        $this->set('proveedores', $proveedores);
        $this->set('gastos', $gastos );        
    }

    public function history()
    {
        $this->Prg->commonProcess('Gasto', array('paramType' => 'querystring'));
        $this->Prg->presetForm('Gasto');
        $conditions = $this->Gasto->parseCriteria( $this->Prg->parsedParams() );

        if ( !array_key_exists('Gasto.fecha >=', $conditions) && !array_key_exists('Gasto.fecha <=', $conditions)) {
            $conditions['Gasto.fecha >='] = $this->request->data['Gasto']['fecha_desde'] = date('Y-m-d', strtotime('-1 month'));
            $conditions['Gasto.fecha <='] = $this->request->data['Gasto']['fecha_hasta'] = date('Y-m-d', strtotime('now'));
        }

        $tp = $this->Gasto->TipoFactura->find('list');
        $this->set('tipo_facturas', $tp);

        $this->set('proveedores', $this->Gasto->Proveedor->find('list'));
        $this->set('clasificaciones', $this->Gasto->Clasificacion->find('list'));
        $this->set('tipo_impuestos', $this->Gasto->TipoImpuesto->find('list'));
        
        $ops = array(
            'conditions' => $conditions,
            'recursive' => 1,
        );
        $gastos = $this->Gasto->find('all', $ops);
        $gastos = $this->Gasto->completarConImportePagado($gastos);
        $this->set(compact('gastos'));
    }



    public function view($id = null)
    {

        if (!$this->Gasto->exists($id) ) {
            $this->redirect(array('action' => 'index'));
        }

        $this->Gasto->contain(array(
            'Proveedor',
            'Cierre',
            'Clasificacion',
            'TipoFactura',
            'Egreso' => array('TipoDePago', 'Media'),
            'Impuesto' => 'TipoImpuesto',
            'Media',
            'Pedido'=>array(
                'PedidoMercaderia'=>array('Mercaderia' => 'UnidadDeMedida'),
            ),
        ));

        $this->set('gasto', $this->Gasto->completarConImportePagado( $this->Gasto->read(null, $id) ) );
    }
    
    
    public function add()
    {
        $this->pageTitle = 'Nuevo Gasto';
        if (!empty($this->request->data)) {
           $this->Gasto->create();
            
            if ($this->Gasto->save($this->request->data)) {
                $this->Session->setFlash(__('The Gasto has been saved', true));

                if (!empty($this->request->data['Gasto']['pagar'])) {
                    $this->redirect( array(
                            'controller' => 'egresos',
                            'action' => 'add',
                            $this->Gasto->id
                        ));
                }
                
            } else {
                $this->Session->setFlash("Error al guardar el gasto", 'Risto.flash_error');
            }
            $this->redirect($this->referer());
        }
        $this->request->data['Gasto']['fecha'] = date('Y-m-d', strtotime('now'));
        $tipoFacturas = $this->Gasto->TipoFactura->find('list');
        $this->set('tipo_impuestos', $this->Gasto->TipoImpuesto->find('all', array('recursive' => -1)));
        $impuestos = $this->Gasto->Impuesto->find('all');
        $clasificaciones = $this->Gasto->Clasificacion->generateTreeList();
        $proveedores = $this->Gasto->Proveedor->find('list', array(
            'order' => array('Proveedor.name')
                ));
               
        $this->set(compact('proveedores', 'tipoFacturas', 'clasificaciones'));
        $this->render('form');
    }


    /**
     * 
     * Lista los tipo impuestos por proveedor
     * si no se le pasa ningun proveedor como parametro
     * listara TODOs los tipo impuestos existentes
     * 
     * 
     **/
    public function impuestos_del_proveedor( $proveedor_id = null ) {
        $tipoImpuestos = array();
if ($this->Gasto->Proveedor->exists($proveedor_id)) {
        $this->Gasto->Proveedor->id = $proveedor_id;
        $this->Gasto->Proveedor->contain(array(
            'TipoImpuesto',
            ));
        $proveedor = $this->Gasto->Proveedor->read();

        if (!empty($proveedor['TipoImpuesto'])) {
            foreach ( $proveedor['TipoImpuesto'] as $tp ) {
                $tipoImpuestos[$tp['id']] = array('TipoImpuesto' => $tp);
            }
        }

        $this->set('tipo_impuestos', $tipoImpuestos);

        if (!empty($this->request->data['Impuesto'])){
            $imps = $this->request->data['Impuesto'];
            $this->request->data['Impuesto'] = array();
            foreach ($imps as $i) {
                $this->request->data['Impuesto'][$i['tipo_impuesto_id']] = $i;
            }
        }
      } else {
        $tipoImpuestos = $this->Gasto->TipoImpuesto->find('all', array('recursive' => -1));
        $this->set('tipo_impuestos', $tipoImpuestos);
      }
    }



    public function impuestos_del_gasto( $id ) {
        $tipoImpuestos = array();

        if ( empty($this->request->data) ) {
            $this->Gasto->contain(array(
                'Impuesto',
                'TipoImpuesto',
                'Proveedor.TipoImpuesto',
                ));
            $this->request->data = $this->Gasto->read(null, $id);
        }

if (isset($this->request->data['Proveedor']['TipoImpuesto'])) {
        foreach ( $this->request->data['Proveedor']['TipoImpuesto'] as $tp ) {
            $tipoImpuestos[$tp['id']] = array('TipoImpuesto' => $tp);
        }
    } else {
        foreach ( $this->request->data['TipoImpuesto'] as $tp ) {
            $tipoImpuestos[$tp['id']] = array('TipoImpuesto' => $tp);
        }
    }
        $this->set('tipo_impuestos', $tipoImpuestos);

        if (!empty($this->request->data['Impuesto'])){
            $imps = $this->request->data['Impuesto'];
            $this->request->data['Impuesto'] = array();
            foreach ($imps as $i) {
                $this->request->data['Impuesto'][$i['tipo_impuesto_id']] = $i;
            }
        }
    }

    public function edit($id = null)
    {
        if ( !$this->Gasto->exists($id) ) {
            $this->Session->setFlash(__('Invalid Gasto', true));
            $this->redirect(array('action' => 'index'));
        }

        if ( $this->request->is(array('post', 'put')) && !empty($this->request->data)) {
            if ($this->Gasto->save($this->request->data)) {

                $this->Session->setFlash(__('The Gasto has been saved', true));

                if (!empty($this->request->data['Gasto']['pagar'])) {
                    $this->redirect( array(
                            'controller' => 'egresos',
                            'action' => 'add',
                            $this->Gasto->id
                        ));
                }
                
                $this->redirect($this->referer());
            } else {             
                $this->Session->setFlash(__('The Gasto could not be saved. Please, try again.'), 'Risto.flash_error');
                debug($this->Gasto->validationErrors);
            }
        }


        $this->Gasto->contain(array(
                'Impuesto',
                'TipoImpuesto',
                'Proveedor.TipoImpuesto',
                ));
        $this->request->data = $this->Gasto->read(null, $id);

        $this->impuestos_del_gasto($id);

        // si el gasto esta cerrado, no permitir que pueda ser modificado
        if (empty($this->request->data)) {

            if ($this->request->data['Gasto']['cierre_id']) {
                $this->Session->setFlash('El gasto ya está "Cerrado", no puede ser modificado', 'Risto.flash_error');
                $this->redirect(array('action'=>'view', $id));
            }
        }

        
        $tipoFacturas = $this->Gasto->TipoFactura->find('list');
        $clasificaciones = $this->Gasto->Clasificacion->generateTreeList();
        $proveedores = $this->Gasto->Proveedor->find('list', array(
            'order' => array('Proveedor.name')
                ));

        
        if (!empty($this->request->data['Proveedor']['id'])) {
            $cuit = '';
            if ( !empty($this->request->data['Proveedor']['cuit']) ) {
                $cuit = ' ('.$this->request->data['Proveedor']['cuit'] .')';
            }
            $this->request->data['Gasto']['proveedor_list'] = $this->request->data['Proveedor']['name'].$cuit;
        }
        $this->set('title_for_layout', __("Editando Gasto #%s", $id));
        $this->set(compact('proveedores', 'tipoFacturas', 'clasificaciones'));
        $this->render('form');
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Gasto', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Gasto->delete($id)) {
            $this->Session->setFlash(__('Gasto deleted', true));
            if ( !$this->RequestHandler->isAjax() ) {
                $this->redirect($this->referer());
            }
        }
        $this->Session->setFlash(__('The Gasto could not be deleted. Please, try again.', true));
        $this->redirect($this->referer);
    }

}

