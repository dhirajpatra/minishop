<?php
return array(
		'controllers' => array(
				'invokables' => array(
						'Admin\Controller\Admin' => 'Admin\Controller\AdminController',
						'Admin\Controller\Category' => 'Admin\Controller\CategoryController',
						'Admin\Controller\Product' => 'Admin\Controller\ProductController',
						'Admin\Controller\User' => 'Admin\Controller\UserController',
				),
		),
		// The following section is new and should be added to your file
		'router' => array(
				'routes' => array(
						'admin' => array(
								'type'    => 'Segment',
								'options' => array(
										'route'    => '/admin[/:action][/:id]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'Admin\Controller\Admin',
												'action'     => 'index',
										),
								),					
						),
									
						'category' => array(
								'type' => 'Segment',
								'options' => array(
										'route'    => '/admin/category[/:action][/:id]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'Admin\Controller\Category',
												'action'     => 'index',
										)
								),
						),
						'product' => array(
								'type' => 'Segment',
								'options' => array(
										'route'    => '/admin/product[/:action][/:id]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'Admin\Controller\Product',
												'action'     => 'index',
										)
								),
						),
						'user' => array(
								'type' => 'Segment',
								'options' => array(
										'route'    => '/admin/user[/:action][/:id]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
										),
										'defaults' => array(
												'controller' => 'Admin\Controller\User',
												'action'     => 'index',
										)
								),
						),
						/*'may_terminate' => true,
						'child_routes' => array(
								'search' => array(
										'type' => 'Literal',
										'options' => array(
												'route' => '/search',
										),
								),
						),*/
				),	
		),
		
		'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);