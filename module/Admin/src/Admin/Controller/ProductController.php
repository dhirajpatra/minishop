<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\ProductForm;

class ProductController extends AbstractActionController
{
	
	protected $productTable;
	
	public function indexAction()
	{
		
		return new ViewModel(array(
				'products' => $this->getProductTable()->fetchAll(),
		));
	}

	public function addAction()
	{
		$tableGateway = $this->getServiceLocator()->get('Application\Model\ProductTable');
		$categoryGateway = $this->getServiceLocator()->get('Application\Model\CategoryTable');
		$form = new ProductForm($tableGateway, $categoryGateway);
		$form->get('submit')->setAttribute('value', 'Add');
		$request = $this->getRequest();
		if ($request->isPost()) {
			$product = new Product();
			$form->setInputFilter($product->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$product->exchangeArray($form->getData());
				$this->getProductTable()->saveProduct($product);
				// Redirect to list of Categorys
				return $this->redirect()->toRoute('product');
			}
		}
		
		return array('form' => $form);
	}

	public function editAction()
	{
		
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('product', array(
					'action' => 'add'
					));
		} 
		$product = $this->getProductTable()->getProduct($id);
		
		$tableGateway = $this->getServiceLocator()->get('Application\Model\ProductTable');	
		$categoryGateway = $this->getServiceLocator()->get('Application\Model\CategoryTable');
				
		$form = new ProductForm($tableGateway, $categoryGateway); 
		$form->bind($product);  
		$form->get('submit')->setAttribute('value', 'Update'); 
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($product->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getProductTable()->saveProduct($product);
						// Redirect to list of Categorys
				return $this->redirect()->toRoute('product');
			}
		}
		return array(
			'id' => $id,
			'form' => $form,
		);
		
	}

	public function deleteAction()
	{
		
		echo 'delete';
	}
	
			
	public function getProductTable()
	{
		if (!$this->productTable) {
			$sm = $this->getServiceLocator();
			$this->productTable = $sm->get('Application\Model\ProductTable');
		}
		return $this->productTable;
	}
	
		
}