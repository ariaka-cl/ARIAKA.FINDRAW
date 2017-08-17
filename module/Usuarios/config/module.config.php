<?php
namespace Usuarios;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Usuarios\Controller\Factory\UsuariosControllerFactory;

return [
    'controllers' => [
        'factories' => [
          Controller\UsuariosController::class => InvokableFactory::class,
          Controller\UsuariosController::class => UsuariosControllerFactory::class
        ],
    ],
    'router' => [
        'routes' => [
            'usuarios' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/usuarios[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UsuariosController::class,
                        'action'  =>'index',                       
                    ],                    
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'usuarios' => __DIR__ . '/../view',
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