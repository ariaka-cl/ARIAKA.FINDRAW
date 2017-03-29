<?php
namespace Ventas;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\VentasController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'ventas' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/ventas[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\VentasController::class,
                        'action'  =>'index',                       
                    ],                    
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'ventas' => __DIR__ . '/../view',
        ],
    ],
];