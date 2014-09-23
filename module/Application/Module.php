<?php
/**
 * Mini Shop 
 *
 * @link      http://github.com/dhirajpatra for the canonical source repository
 * @copyright Copyright (c) 2014 Dhiraj Patra (http://www.in.lnkedin.com/dhirajpatra/)
 * @license   Dhiraj Patra New BSD License
 */


namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Model\Category;
use Application\Model\CategoryTable;
use Application\Model\Product;
use Application\Model\ProductTable;
use Application\Model\Cart;
use Application\Model\CartTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    
   
    public function getAutoloaderConfig()
    {
        return array(
        		'Zend\Loader\ClassMapAutoloader' => array(
        				__DIR__ . '/autoload_classmap.php',
        		),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    					
		    	'Application\Model\CategoryTable' =>  function($sm) {
			    	$tableGateway = $sm->get('CategoryTableGateway');
			    	$table = new CategoryTable($tableGateway);
			    	return $table;
		    	},
		    	'CategoryTableGateway' => function ($sm) {
			    	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
			    	$resultSetPrototype = new ResultSet();
			    	$resultSetPrototype->setArrayObjectPrototype(new Category());
			    	return new TableGateway('categories', $dbAdapter, null, $resultSetPrototype);
		    	},
		    	'Application\Model\ProductTable' =>  function($sm) {
	    			$tableGateway = $sm->get('ProductTableGateway');
	    			$table = new ProductTable($tableGateway);
	    			return $table;
		    	},
		    	'ProductTableGateway' => function ($sm) {
			    	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
			    	$resultSetPrototype = new ResultSet();
			    	$resultSetPrototype->setArrayObjectPrototype(new Product());
			    	return new TableGateway('products', $dbAdapter, null, $resultSetPrototype);
		    	},
		    	'Application\Model\CartTable' =>  function($sm) {
	    			$tableGateway = $sm->get('CartTableGateway');
	    			$table = new CartTable($tableGateway);
	    			return $table;
		    	},
		    	'CartTableGateway' => function ($sm) {
			    	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
			    	$resultSetPrototype = new ResultSet();
			    	$resultSetPrototype->setArrayObjectPrototype(new Cart());
			    	return new TableGateway('carts', $dbAdapter, null, $resultSetPrototype);
		    	},
    		),
    	);
    }
}
