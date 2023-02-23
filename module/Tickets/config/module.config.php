<?php

namespace Tickets;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
	'router' => [
		'routes' => [
			'tickets' => [
				'type' => \Zend\Router\Http\Segment::class,
				'options' => [
					'route' => '/tickets[/:action[/:id]]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+'
					],
					'defaults' => [
						'controller' => Controller\TicketsController::class,
						'action' => 'index',
					],
				],
			],
		],
	],
	'controllers' => [
		'factories' => [
			// Controller\PessoaController::class => InvokableFactory::class,
		],
	],
	'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'tickets/index/index' => __DIR__ . '/../view/tickets/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
	'db' => [
		'driver' => 'Pdo_Mysql',
		'database' => 'zend',
		'username' => 'root',
		'password' => '',
		'hostname' => 'localhost'
	]
];
?>