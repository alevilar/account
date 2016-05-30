<?php
App::uses('AppController', 'Controller');

class AccountAppController extends AppController
{

	public $layout = 'Account.default';
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');
      
    }

}
