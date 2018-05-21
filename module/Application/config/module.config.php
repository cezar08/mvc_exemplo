<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller\IndexController;
use Application\Controller\PessoasController;
use Application\Service\User;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'pessoas_show' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/pessoas/[:id]',
                    'defaults' => [
                        'controller' => Controller\PessoasController::class,
                        'action'     => 'show',
                    ],
                ],
            ],
            'pessoas_index' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/pessoas',
                    'defaults' => [
                        'controller' => Controller\PessoasController::class,
                        'action' => 'index'
                    ]
                    ],
                ],
            'pessoas_create' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/pessoas/create',
                    'defaults' => [
                        'controller' => Controller\PessoasController::class,
                        'action' => 'create'
                    ]
                ],
            ],
//                'may_terminate' => false,
//                'child_routes' => [
//                    'post' => [
//                        'type' => 'method',
//                        'options' => [
//                            'verb' => 'post',
//                            'defaults' => [
//                                'controller' => Controller\PessoasController::class,
//                                'action' => 'create'
//                            ]
//                        ]
//                    ],
//                    'delete' => [
//                      'type' => 'method',
//                        'options' => [
//                            'verb' => 'delete',
//                            'defaults' => [
//                                'controller' => Controller\PessoasController::class,
//                                'action' => 'delete'
//                            ]
//                        ]
//                    ],
//                    'put' => [
//                        'type' => 'method',
//                        'options' => [
//                            'verb' => 'put',
//                            'defaults' => [
//                                'controller' => Controller\PessoasController::class,
//                                'action' => 'update'
//                            ]
//                        ]
//                    ],
//                ]
//            ],

            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => function($sm) {
                return new IndexController($sm);
            },
            Controller\PessoasController::class => function ($sm) {
                $em =  $sm->get('Doctrine\ORM\EntityManager');
                $userService = $sm->get('UserService');

                return new PessoasController($em,$userService);
            }
        ],
    ],
    'service_manager' => [
        'factories' => [
            'UserService' => function ($sm) {
                $em =  $sm->get('Doctrine\ORM\EntityManager');

                return new User($em);
            }
        ]
    ],
    'doctrine' => [
        'driver' => [
            'application_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'application_entities'
                ]
            ]
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ],
];
