<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
	
	protected $adminTable;
	
	public function indexAction()
	{
		return new ViewModel(array(
				'admins' => $this->getAdminTable()->fetchAll(),
		));
	}

	public function addAction()
	{
	}

	public function editAction()
	{
	}

	public function deleteAction()
	{
	}
	
	
	public function getAdminTable()
	{
		if (!$this->adminTable) {
			$sm = $this->getServiceLocator();
			$this->adminTable = $sm->get('Admin\Model\AdminTable');
		}
		return $this->adminTable;
	}
	
		
}