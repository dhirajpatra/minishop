<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;

class ProductTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
		$this->select = new Select();
	}

	public function fetchAll()
	{

		$sqlSelect = $this->tableGateway->getSql()->select();
		$sqlSelect->columns(array('*'));
		$sqlSelect->join('categories', 'categories.id = products.category_id', array('category'), 'inner');
				
		$resultSet = $this->tableGateway->selectWith($sqlSelect);
		
		//echo $sqlSelect->getSqlString();
		
		//$row = $rowset->current();
		if (!$resultSet) {
			throw new \Exception("Could not find row $user_id");
		}
		return $resultSet;
	}

	public function getProduct($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	
	public function getProductFromCategory($cat_id)
	{
		$cat_id  = (int) $cat_id;
		$rowset = $this->tableGateway->select(array('category_id' => $cat_id));
		//$row = $rowset->current();
		if (!$rowset) {
			throw new \Exception("Could not find row $cat_id");
		}
		return $rowset;
	}
	
	
	public function getProductFromParentCategory($cat_id)
	{
		$cat_id  = (int) $cat_id;

		$where = new Where();
		$where->equalTo('categories.parentid', $cat_id);
		$sqlSelect = $this->tableGateway->getSql()->select()->where($where);
		$sqlSelect->columns(array('*'));
		$sqlSelect->join('categories', 'categories.id = products.category_id', array('parentid','category'), 'inner');
		//echo $sqlSelect->getSqlString();
		$resultSet = $this->tableGateway->selectWith($sqlSelect);
						
		//$row = $rowset->current();
		if (!$resultSet) {
			throw new \Exception("Could not find row $user_id");
		}
		return $resultSet;
	}
	
	
	public function getFeaturedProducts()
	{
		
		$rowset = $this->tableGateway->select(array('featured' => 1));
		//$row = $rowset->current();
		if (!$rowset) {
			throw new \Exception("Could not find row $id");
		}
		return $rowset;
	}

	public function saveProduct(Product $Product)
	{
		$data = array(
				'category_id' => $Product->category_id,
				'product' => $Product->product,
				'price' => $Product->price,
				'shortdescription' => $Product->shortdescription,
				'detailsdescription' => $Product->detailsdescription,
				'image' => $Product->image,
				'quantity' => $Product->quantity,
				'featured' => $Product->featured,
		);

		$id = (int)$Product->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getProduct($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}

	public function deleteProduct($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}