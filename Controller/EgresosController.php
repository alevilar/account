<?php

App::uses('AccountAppController', 'Account.Controller');

class EgresosController extends AccountAppController
{
   
     public function index () {
        $this->history();
        $this->elementMenu = 'Cash.menu';
        $this->render('history');
     }


    public function history ()
    {
        $this->pageTitle = "Pagos Realizados";

        $this->Prg->commonProcess('Egreso', array('paramType' => 'querystring'));
        $this->Prg->presetForm('Egreso');
        $conditions = $this->Egreso->parseCriteria( $this->Prg->parsedParams() );

        
        if ( !array_key_exists('DATE(Egreso.fecha) >=', $conditions) && !array_key_exists('DATE(Egreso.fecha) <=', $conditions) ) {
            $conditions['DATE(Egreso.fecha) >='] = $this->request->data['Egreso']['fecha_desde'] = date('Y-m-d', strtotime('-2 day'));
            $conditions['DATE(Egreso.fecha) <='] = $this->request->data['Egreso']['fecha_hasta'] = date('Y-m-d', strtotime('now'));
        }
        
        
        $this->Paginator->settings = array(
            'contain' => array(
                'TipoDePago',
                'Media',
                'Gasto' => array(
                    'Proveedor',
                    'TipoFactura',
                ),
            ),
            'recursive' => 1,
            'conditions' => $conditions,
        );

        $this->set('proveedores', $this->Egreso->Gasto->Proveedor->find('list'));
        $this->set('tipoDePagos', $this->Egreso->TipoDePago->find('list'));
        $this->set('egresos', $this->paginate());
    }

  public function redireccionar($arqueoId) {
          if($arqueoId == null) {
          $this->redirect(array('action'=>'history'));
        } else {
          $this->redirect(array('plugin'=>'cash', 'controller'=>'arqueos', 'action'=>'listar_pagos', $arqueoId));
        }
  }

    public function edit($egreso_id, $arqueoId = null)
    {
        if ($this->request->is(array('post', 'put')) && !empty($this->request->data)) {            
            if ( !$this->Egreso->save($this->request->data) ) {
                $this->Session->setFlash('El pago no pudo ser guardado', 'Risto.flash_error');
            } else {
                $this->Session->setFlash('El Pago fue guardado');
            }

        }

        $this->request->data = $this->Egreso->read(null, $egreso_id);
        $this->set('tipoDePagos', $this->Egreso->TipoDePago->find('list'));
        $this->set(compact('arqueoId'));
        $this->render('form');
    }

    public function add($gasto_id = null)
    {    
        $gastos = array();
        if (!empty($gasto_id)) {
            $gastos[] = $gasto_id;
        }

        $suma_gastos = 0;
        $cant_gastos = 0;
        $gastosAll = array();
        if (!empty($this->request->data['Gasto'])) {
            
            // re armo el array de gastos limpiando los que no fueron seleccionados para pagar
            foreach ($this->request->data['Gasto'] as $g) {
                if ($g['gasto_seleccionado']) {
                    $gastos[] = $g['gasto_seleccionado'];
                }
            }
            $cant_gastos = count($gastos);
        }

        if (!empty($gastos)) {
            // calculo la suma total del los gastos $$ seleccionados
            $gastosAll = $this->Egreso->Gasto->find('all', array(
                'conditions' => array(
                    'Gasto.id' => $gastos,
                ),
                'contain' => array('Egreso'),
                ));
            $gastosAll = $this->Egreso->Gasto->completarConImportePagado($gastosAll);
            foreach ($gastosAll as $g) {
                $suma_gastos += $g['Gasto']['importe_total'] - $g['Gasto']['importe_pagado'];
            }

            $this->set('gastos', $this->Egreso->Gasto->find('list', array(
                        'conditions' => array(
                            'Gasto.id' => $gastos,
                        )
                    )));
        } else {
            $this->flash('Error, se debe seleccionar algun gasto', array('index'));
        }

        if (count($gastos) > 1) {
            $this->pageTitle = 'Pagando ' . count($gastos) . ' Gastos';
        } else {
            $this->pageTitle = 'Pagando ' . count($gastos) . ' Gasto';
        }
        $this->request->data['Egreso']['redirect'] = $this->referer();
        $this->request->data['Egreso']['fecha'] = $date = date('Y-m-d H:i', strtotime('now'));
        $this->request->data['Egreso']['total'] = $suma_gastos;
        $this->set('tipoDePagos', $this->Egreso->TipoDePago->find('list'));
        $this->request->data['Gasto'] = $gastos;
        $this->set('cant_gastos', $cant_gastos);
        $this->set('gastosAll', $gastosAll);
        $this->render('form');
    }

    public function save()
    {
        if ( $this->request->is(array('post', 'put')) && !empty($this->request->data) ) {
            $this->Egreso->create();
            $fields = array('fecha','tipo_de_pago_id','observacion', 'fecha', 'media_id');
            if (isset($this->data['Egreso']['total'])){
                $fields[] = 'total';
            }
            if ($this->Egreso->save($this->request->data, true, $fields)) {
                $this->Session->setFlash('El Pago fue guardado correctamente');
            } else {
                debug($this->Egreso->validationErrors);die;
                $this->Session->setFlash('Error al guardar el pago', 'Risto.flash_error');
            }
            $redirect = $this->referer();
            if ( !empty($this->request->data['Egreso']['redirect']) ) {
                $redirect = $this->request->data['Egreso']['redirect'];
            }
            $this->redirect( $redirect );
        }
    }

    public function view($id)
    {
        if (empty($id)) {
            $this->flash('No se pasó un ID de pago correcto', array('controller' => 'gastos', 'action' => 'index'));
        }
        $this->Egreso->id = $id;
        $this->Egreso->contain(array(
            'TipoDePago',
            'Gasto' => array(
                    'Proveedor',
                    'Clasificacion',
                    'Media',
                    'TipoFactura',
                    'Cierre',
                    'TipoImpuesto'
                )
        ));

        
        $egreso = $this->Egreso->read();
        $gastos = Hash::extract($egreso, 'Gasto.{n}');

        $this->set(compact( 'egreso', 'gastos'));
    }
    
    
    public function delete($id = null, $arqueoId = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Egreso', true));
            $this->redirect(array('action' => 'history'));
        }
        if ($this->Egreso->delete($id)) {
            $this->Session->setFlash(__('Egreso deleted', true));
            if ( !$this->request->is('ajax') ) {
                $this->redireccionar($arqueoId);
            }
        }
        $this->Session->setFlash(__('The Egreso could not be deleted. Please, try again.', true));
    }

}

