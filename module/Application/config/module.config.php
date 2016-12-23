<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Event' => 'Application\Controller\EventController',
            'Application\Controller\Calendar' => 'Application\Controller\CalendarController',
            'Application\Controller\Profile' => 'Application\Controller\ProfileController',
        ),
    ),
    'navigation' => array(
        'main_nav' => array(
            'home' => array(
                'label' => 'Kalender',
                'route' => 'home',
                'resource'  => 'controller/Application\Controller\Index',
            ),
            'convention' => array(
                'label' => 'Convention',
                'route' => 'event',
                'pages' => array(
                    'add' => array(
                        'label' => 'Neue Convention',
                        'route' => 'event',
                        'action' => 'add',
                        'resource'  => 'controller/Application\Controller\Event',
                    ),
                    'list' => array(
                        'label' => 'Convention Liste',
                        'route' => 'event',
                        'resource'  => 'controller/Application\Controller\Event',
                    ),
                ),
            ),
        ),
        'top_nav' => array(
            'profile' => array(
                'label' => 'Profil',
                'route' => 'profile',
                'pages' => array(
                'login' => array(
                    'label' => 'Login',
                    'route' => 'zfcuser/login',
                    #'action' => 'login',
                    'resource'  => 'controller/zfcuser:login',
                ),
                'register' => array(
                    'label' => 'Register',
                    'route' => 'zfcuser/register',
                    #'action' => 'register',
                    'resource'  => 'controller/zfcuser:register',
                ),
                'profile' => array(
                    'label' => 'My Profile',
                    'route' => 'profile',
                    'action' => '',
                    'resource'  => 'controller/Application\Controller\Profile',
                ),
                'logout' => array(
                    'label' => 'Logout',
                    'route' => 'zfcuser/logout',
                    #'action' => 'logout',
                    'resource'  => 'controller/zfcuser:logout',
                ),
                ),
            ),
            /*'admin' => array(
                'label' => 'AdminPanel',
                'route' => 'admin',
                'resource'  => 'controller/Admin\Controller\Index',
            ),
            'onsite' => array(
                'label' => 'Onsite',
                'route' => 'onsite',
                'resource'  => 'controller/OnsiteReg\Controller\Index',
            ),*/
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'profile' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/profile[/][:action][/:hashkey]',
                    'constraints' => array(
                        'action'   => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'hashkey'  => '[A-Z0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Profile',
                        'action'     => 'index',
                    ),
                ),
            ),
            'calendar' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/calendar[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Calendar',
                        'action' => 'index',
                    ),
                ),
            ),
            'event' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/event[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Event',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'main_nav' => 'Application\Service\MainNavigationFactory',
            'top_nav'  => 'Application\Service\TopNavigationFactory',
        ),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
            'Logger'     => 'EddieJaoude\Zf2Logger',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
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
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    
    'doctrine' => array(
        'driver' => array(
            'inbaz_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Entity'),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'inbaz_entities'
                )
            )
        )
    ),
    
    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class'       => 'Application\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
    ),
 
    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
 
        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                #'object_manager'    => 'doctrine.entity_manager.orm_default',
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'Application\Entity\Role',
            ),
        ),
    ),
    
);
