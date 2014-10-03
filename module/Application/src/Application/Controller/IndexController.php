<?php
/**
 * Mini Shop 
 *
 * @link      http://github.com/dhirajpatra for the canonical source repository
 * @copyright Copyright (c) 2014 Dhiraj Patra (http://www.in.lnkedin.com/dhirajpatra/)
 * @license   Dhiraj Patra New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
	
	protected $categoryTable;
	protected $productTable;
	protected $cartTable;
	
	/**
	 * (non-PHPdoc)
	 * @see Zend\Mvc\Controller.AbstractActionController::indexAction()
	 */
    public function indexAction()
    {	
    	$userId = 1; // need to take from session
        return new ViewModel(array(
    			'categories' => $this->getCategoryTable()->fetchAll(),
        		'products' => $this->getProductTable()->getFeaturedProducts(),
        		'carts' => $this->getCartTable()->getCart($userId),
    	));
    }
    
    /**
     * this function will show all categories
     */
    public function showcategoryAction(){
    	
    	$result = new JsonModel(array(
	    'categories' => 'categories',
            'success'=>true,
        ));

        return $result;
    }
    
    /** 
     * this function will show all feature products
     */
    public function showfeatureproductsAction(){
    	
    	
    }
    
    /**
     * this function willl show products in cart
     */
    public function showcartAction(){
    	
    	
    }
    
	 
    
    public function getCategoryTable()
    { 
    	if (!$this->categoryTable) {
    		$sm = $this->getServiceLocator(); 
    		$this->categoryTable = $sm->get('Application\Model\CategoryTable'); 
    	}
    	return $this->categoryTable;
    }
    
    public function getProductTable()
    {
    	if (!$this->productTable) {
    		$sm = $this->getServiceLocator();
    		$this->productTable = $sm->get('Application\Model\ProductTable');
    	}
    	return $this->productTable;
    }
    
    
    public function getCartTable()
    {
    	if (!$this->cartTable) {
    		$sm = $this->getServiceLocator();
    		$this->cartTable = $sm->get('Application\Model\CartTable');
    	}
    	return $this->cartTable;
    }
    
}
