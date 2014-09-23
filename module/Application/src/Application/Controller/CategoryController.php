<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class CategoryController extends AbstractActionController
{
	
	protected $categoryTable;
	
	public function indexAction()
	{
		
		return new ViewModel(array(
				'categories' => $this->getCategoryTable()->fetchAll(),
		));
	}

	public function getProducts($category_id = null){
		
		echo $category_id; 
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