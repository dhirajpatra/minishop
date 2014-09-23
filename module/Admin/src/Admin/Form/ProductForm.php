<?php
namespace Admin\Form;
use Zend\Form\Form;
use Application\Model\ProductTable;
use Application\Model\CategoryTable;

class ProductForm extends Form
{ 
	protected $productTable;
	protected $categoryTable;
	
	public function __construct(ProductTable $productTable, CategoryTable $categoryTable, $name = null)
	{ 
		$this->productTable = $productTable; 
		$this->categoryTable = $categoryTable;
		
		// we want to ignore the name passed
		parent::__construct('Product');
		$this->setAttribute('method', 'post');
		$this->add(array(
			'name' => 'id',
			'attributes' => array(
			'type' => 'hidden',
			),
		));
		
		//$this->addElement(new Admin_Form_Element_ProductSelect('parentid'));
				
		$this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category_id',
            'options' => array(
                'label' => 'Category',
                'value_options' => $this->getOptionsForCategorySelect(),
            	'empty_option' => 'Select'
            ),
            'attributes' => array(
                'value' => '1' //set selected to '1'
            )
        ));
		
		$this->add(array(
				'name' => 'product',
				'attributes' => array(
						'type' => 'text',
				),
				'options' => array(
						'label' => 'Product',
				),
		));
		
		$this->add(array(
				'name' => 'price',
				'attributes' => array(
						'type' => 'text',
				),
				'options' => array(
						'label' => 'Price',
				),
		));
		
		$this->add(array(
				'name' => 'shortdescription',
				'attributes' => array(
						'type' => 'textarea',
						'maxlength' => '255',
						'cols' =>  '50',
						'row' => '5',
				),
				'options' => array(
						'label' => 'Short Description',
				),
		));
		
		$this->add(array(
				'name' => 'detailsdescription',
				'attributes' => array(
						'type' => 'textarea',
						'maxlength' => '255',
						'cols' =>  '50',
						'row' => '5',
				),
				'options' => array(
						'label' => 'Details Description',
				),
		));
		
		$this->add(array(
				'name' => 'image',
				'attributes' => array(
						'type' => 'text',
				),
				'options' => array(
						'label' => 'Image',
				),
		));
		
		$this->add(array(
				'name' => 'quantity',
				'attributes' => array(
						'type' => 'text',
				),
				'options' => array(
						'label' => 'Stock',
				),
		));
		
		$this->add(array(
				'name' => 'featured',
				'attributes' => array(
						'type' => 'text',
				),
				'options' => array(
						'label' => 'Featured Product',
				),
				
		));
        
		/*
		$this->add(array(
                'type' => 'Admin_Form_Element_ProductSelect',
                'name' => 'parentid',
                'tabindex' =>2,
                'options' => array(
                        'label' => 'Parent Product',
                        'empty_option' => 'Select',
                        //'value_options' => $this->getOptionsForProductSelect(),
                )
        ));
		*/
		/*
		$this->add(array(
			'name' => 'parentid',
			'attributes' => array(
			'type' => 'text',
			),
			'options' => array(
			'label' => 'Parent Product',
			),
		));
		*/
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
			'type' => 'submit',
			'value' => 'Go',
			'id' => 'submitbutton',
			),
		));
	}
	
	public function getOptionsForCategorySelect()
	{ 
		$table = $this->categoryTable;
		$data  = $table->fetchAll();
		
		$selectData = array();
		
		foreach ($data as $selectOption) {
			$selectData[$selectOption->id] = $selectOption->category;
		}
	
		return $selectData;
	}
		
}

