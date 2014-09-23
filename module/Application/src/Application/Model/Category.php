<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;


class Category
{
	public $id;
	public $category;
	public $parentid;
	public $inputFilter;
	public $inputFactory;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id'])) ? $data['id'] : null;
		$this->category = (isset($data['category'])) ? $data['category'] : null;
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
					'name' => 'category',
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
			
			$this->inputFilter = $inputFilter;
		}
		
		return $this->inputFilter;
	}
}