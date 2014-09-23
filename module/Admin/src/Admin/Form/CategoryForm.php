<?php
namespace Admin\Form;
use Zend\Form\Form;
use Application\Model\CategoryTable;

class CategoryForm extends Form
{ 
	protected $categoryTable;
	
	public function __construct(CategoryTable $categoryTable, $name = null)
	{ 
		$this->categoryTable = $categoryTable; 
		// we want to ignore the name passed
		parent::__construct('Category');
		$this->setAttribute('method', 'post');
		$this->add(array(
			'name' => 'id',
			'attributes' => array(
			'type' => 'hidden',
			),
		));
		
		//$this->addElement(new Admin_Form_Element_CategorySelect('parentid'));
		
		$this->add(array(
				'name' => 'category',
				'attributes' => array(
						'type' => 'text',
				),
				'options' => array(
						'label' => 'Category',
				),
		));
		
		$this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'parentid',
            'options' => array(
                'label' => 'Category Parent',
                'value_options' => $this->getOptionsForCategorySelect(),
            	'empty_option' => 'Select'
            ),
            'attributes' => array(
                'value' => '1' //set selected to '1'
            )
        ));
        
		/*
		$this->add(array(
                'type' => 'Admin_Form_Element_CategorySelect',
                'name' => 'parentid',
                'tabindex' =>2,
                'options' => array(
                        'label' => 'Parent Category',
                        'empty_option' => 'Select',
                        //'value_options' => $this->getOptionsForCategorySelect(),
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
			'label' => 'Parent Category',
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

