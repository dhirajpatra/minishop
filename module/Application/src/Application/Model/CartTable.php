<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;

class CartTable
{
	protected $tableGateway;
	protected $select;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
		$this->select = new Select();
		
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getCart($user_id)
	{
		$user_id  = (int) $user_id;

		$where = new Where();
		$where->equalTo('user_id', $user_id);
		$sqlSelect = $this->tableGateway->getSql()->select()->where($where);
		$sqlSelect->columns(array('product_id','user_id','quantity'));
		$sqlSelect->join('products', 'products.id = carts.product_id', array('product','price'), 'inner');
		//echo $sqlSelect->getSqlString();
		$resultSet = $this->tableGateway->selectWith($sqlSelect);
						
		//$row = $rowset->current();
		if (!$resultSet) {
			throw new \Exception("Could not find row $user_id");
		}
		return $resultSet;
	}

	public function saveCart(Cart $Cart)
	{
		$data = array(
				'user_id' => $Cart->user_id,
				'product_id' => $Cart->product_id,
				'quantity'  => $Cart->quantity,
		);

		$id = (int)$Cart->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getCart($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}

	public function deleteCart($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}