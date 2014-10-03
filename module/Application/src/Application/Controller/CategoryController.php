<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CategoryController extends AbstractActionController
{
	
	protected $categoryTable;
	protected $productTable;
	protected $cartTable;
	
	public function indexAction()
	{
		
		$result = new JsonModel(array(
	    'result' => 'This category products is ',
            'success'=>true,
        ));

        return $result;
	}

	
	public function getproductsAction(){
    	
		$id = $this->params()->fromRoute('id');
		
		//$view = new ViewModel(); 
		//$view->setTerminal(true);
   	
    	//echo json_encode($result);
    	$rows = $this->getProductTable()->getProductFromCategory($id);
    	
    	if(count($rows) == 0){
    		
    		$rows = $this->getProductTable()->getProductFromParentCategory($id);
    	}
    	    		
    	$rs = '';
    		
    	foreach ($rows as $row){
    			
    		$rs .= '<div class="category-product" >';
    			 
    		$rs .= '<div style="width:30%; float:left;"><a href="'.$row->id.'">'. $row->product .'</a></div><div style="width:65%; float:right;"><img src="../../public/img/products/'.$row->image.'" width=300px height=300px ></div>';
    		$rs .= '<br clear="all"><div style="width:30%; float:left;">Rs.'.$row->price.'</div><div style="width:65%; float:right;">'.$row->shortdescription.'</div>';
    			
    		$rs .= '</div><br clear="all">';
    			 
    	}
    		
    	$result = new JsonModel(array(
	    'result' => $rs,
            'success'=>true,
        ));

        return $result;
   
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
	
		
}