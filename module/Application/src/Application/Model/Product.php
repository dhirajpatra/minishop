<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;

class Product
{
	public $id;
	public $category_id;
	public $category;
	public $product;
	public $price;
	public $shortdescription;
	public $detailsdescription;
	public $image;
	public $quantity;
	public $featured;
	public $inputFilter;
	public $inputFactory;
	public $parentid;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id'])) ? $data['id'] : null;
		$this->category_id = (isset($data['category_id'])) ? $data['category_id'] : null;
		$this->category = (isset($data['category'])) ? $data['category'] : null;
		$this->product  = (isset($data['product'])) ? $data['product'] : null;
		$this->price  = (isset($data['price'])) ? $data['price'] : null;
		$this->shortdescription  = (isset($data['shortdescription'])) ? $data['shortdescription'] : null;
		$this->detailsdescription  = (isset($data['detailsdescription'])) ? $data['detailsdescription'] : null;
		$this->image  = (isset($data['image'])) ? $data['image'] : null;
		$this->quantity  = (isset($data['quantity'])) ? $data['quantity'] : null;
		$this->featured  = (isset($data['featured'])) ? $data['featured'] : null;
		$this->parentid  = (isset($data['parentid'])) ? $data['parentid'] : null;
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	// Add content to this method:
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
	
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
	
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();
			$inputFilter->add($factory->createInput(array(
					'name' => 'id',
					'required' => true,
					'filters' => array(
							array('name' => 'Int'),
					),
			)));
			$inputFilter->add($factory->createInput(array(
					'name' => 'product',
					'required' => true,
					'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name' => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name' => 'quantity',
					'required' => true,
					'validators' => array(
							array(
									'name' => 'Int',
									'options' => array(
											'min' => 1,
											'max' => 50,
									),
							),
					),
			)));
			
			$inputFilter->add($factory->createInput(array(
					'name' => 'price',
					'required' => true,
					'validators' => array(
							array(
									'name' => 'float',
									'stringLength' => array(1,12),
									'greaterThan' => array('min' => 0),
							),
					),
			)));
				
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
}