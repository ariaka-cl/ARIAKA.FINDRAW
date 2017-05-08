<?php
namespace Ventas;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Ventas\Controller\Factory\VentasControllerFactory;

return [
    'controllers' => [
        'factories' => [
          Controller\VentasController::class => InvokableFactory::class,
          Controller\VentasController::class => VentasControllerFactory::class
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
        'strategies'=> [
            'ViewJsonStrategy',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                 'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]   
];