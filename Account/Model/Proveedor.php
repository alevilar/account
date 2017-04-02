<?php

App::uses('AccountAppModel', 'Account.Model');

class Proveedor extends AccountAppModel {

	public $name = 'Proveedor';
    
    public $order = array('Proveedor.name' => 'ASC');
    
    public $validate = array(
    	'name' => array(
    		'name' => array(
    			'rule' => array('minLength', '1'),
    			'required' => true,
    			'message' => 'Debe especificar un nombre'
    		)
    	),
        'cuit' => array(
            'cuit' => array(
                    'rule' => 'validate_cuit',
                    'message' => 'CUIT inválido',
                    'allowEmpty' => true,
                    'required' => false,
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'El Cuit ya existe',
                'allowEmpty' => true,
            )
        ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array( 'Account.Gasto', 'Compras.Pedido' );


    public $hasAndBelongsToMany = array(
        'TipoImpuesto' => array(
            'className' => 'Account.TipoImpuesto',
            'joinTable' => 'account_proveedores_tipo_impuestos',
            'foreignKey' => 'proveedor_id',
            'associationForeignKey' => 'tipo_impuesto_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',

            ),
        'Rubro' => array(
            'className' => 'Compras.Rubro',
            'joinTable' => 'compras_proveedores_rubros',
            'foreignKey' => 'proveedor_id',
            'associationForeignKey' => 'rubro_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

        
    public function validate_cuit(){
        if (!empty($this->data['Proveedor']['cuit'])) {
             return validate_cuit_cuil($this->data['Proveedor']['cuit']);
        }
        return true;
    }

/**
 * Busca el proveedor según la id.
 *
 * @param int $id ID del proveedor.
 * @return array.
 **/

    public function buscarProveedorPorId($id) {
        return $this->find('first', array('conditions' => array('Proveedor.id' => $id), 'contain' => array('Rubro', 'TipoImpuesto')));
    }

}
