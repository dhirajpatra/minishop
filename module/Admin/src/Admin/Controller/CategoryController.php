<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\CategoryForm;

class CategoryController extends AbstractActionController
{
	
	protected $categoryTable;
	
	public function indexAction()
	{
		
		return new ViewModel(array(
				'categories' => $this->getCategoryTable()->fetchAll(),
		));
	}

	public function addAction()
	{
		$tableGateway = $this->getServiceLocator()->get('Application\Model\CategoryTable');
		$form = new CategoryForm($tableGateway);
		$form->get('submit')->setValue('Add');
		$request = $this->getRequest();
		if ($request->isPost()) {
			$category = new Category();
			$form->setInputFilter($Category->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$category->exchangeArray($form->getData());
				$this->getCategoryTable()->saveCategory($category);
				// Redirect to list of Categorys
				return $this->redirect()->toRoute('category');
			}
		}
		return array('form' => $form);
	}

	public function editAction()
	{
		
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('category', array(
					'action' => 'add'
					));
		} 
		$Category = $this->getCategoryTable()->getCategory($id);
		
		$tableGateway = $this->getServiceLocator()->get('Application\Model\CategoryTable');			
				
		$form = new CategoryForm($tableGateway); 
		$form->bind($Category);  
		$form->get('submit')->setAttribute('value', 'Update'); 
		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($Category->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getCategoryTable()->saveCategory($Category);
						// Redirect to list of Categorys
				return $this->redirect()->toRoute('category');
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
	
			
	public function getCategoryTable()
	{
		if (!$this->categoryTable) {
			$sm = $this->getServiceLocator();
			$this->categoryTable = $sm->get('Application\Model\CategoryTable');
		}
		return $this->categoryTable;
	}
	
		
}