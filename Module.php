<?php
/**
 * @package ZfTwitterBootstrap
 * @copyright Jean Rumeau - http://www.jprumeau.com
 * @license http://www.jprumeau.com/blog/license-new-bsd New BSD License
 * @link http://www.jprumeau.com
 * @link https://github.com/rumeau/zf-twitter-bootstrap
 */

namespace ZfTwitterBootstrap;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Module
 * 
 * @category  ZfTwitterBootstrap
 * @package   ZfTwitterBootstrap
 * @link      http://www.w3.org/Protocols/rfc2616/rfc2616-sec4.html#sec4
 */
class Module extends ModuleManager implements
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
