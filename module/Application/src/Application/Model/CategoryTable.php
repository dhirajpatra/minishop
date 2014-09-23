<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;

class CategoryTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{ 		
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select(); 
		return $resultSet;
	}

	public function getCategory($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current(); 
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	
	public function getOptionsForCategorySelect($id = 0)
	{
		$id  = (int) $id;
		
		if($id == 0){
			
			$rowset = $this->tableGateway->select();
		}else{
			
			$rowset = $this->tableGateway->select(array('id' => $id));
		}
		
		
		if (!$rowset) {
			throw new \Exception("Could not find row $id");
		}
	
		$selectData = array();
	
		foreach ($rowset as $res) {
			$selectData[$res['id']] = $res['category'];
		}
		
		return $selectData;
	}

	public function saveCategory(Category $category)
	{
		$data = array(
				'category' => $category->category,
				'parentid'  => $category->prentid,
		);

		$id = (int)$category->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getCategory($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}

	public function deleteCategory($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}