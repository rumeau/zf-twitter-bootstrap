<?php

namespace ZfTwitterBootstrap\View;

class ViewConfigurator
{
    /**
     * @var Zend\Mvc\Application
     */
    public $application;
    
    /**
     * @var \Zend\View\Renderer\PhpRenderer
     */
    public $view;
    
    public function __construct($application)
    {
        $this->application = $application;
        $sm = $this->application->getServiceManager();
        $em = $this->application->getEventManager();
        
        $this->view = $sm->get('ViewRenderer');
        
        $this->view->doctype('HTML5');
        
        $em->trigger('boostrap', $this->application, array(), array($this, 'onDispatch'));
        
        return $this;
    }
    
    public function onDispatch()
    {
        echo 'asd';
    }
}