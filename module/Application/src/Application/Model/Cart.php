<?php
namespace Application\Model;

class Cart
{
	public $user_id;
	public $product_id;
	public $quantity;
	public $product;
	public $price;

	public function exchangeArray($data)
	{
		$this->user_id     = (isset($data['user_id'])) ? $data['user_id'] : null;
		$this->product_id = (isset($data['product_id'])) ? $data['product_id'] : null;
		$this->quantity  = (isset($data['quantity'])) ? $data['quantity'] : null;
		$this->product  = (isset($data['product'])) ? $data['product'] : null;
		$this->price  = (isset($data['price'])) ? $data['price'] : null;
	}
}