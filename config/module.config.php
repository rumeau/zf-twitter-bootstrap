<?php

use ZfTwitterBootstrap\View\ViewConfigurator;

return array(
    'service_manager' => array(
        'factories' => array(
            'ZfTwitterBootstrap\View\View' => function($sm) {
                $app = $sm->get('Application');
                $view = new ViewConfigurator($app);
                
                return $view;
            }
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'zftwbform'  => 'ZfTwitterBootstrap\Form\View\Helper\Form',
            'zftwbformbutton' => 'ZfTwitterBootstrap\Form\View\Helper\FormButton',
            'zftwbformcheckbox' => 'ZfTwitterBootstrap\Form\View\Helper\FormCheckbox',
            'zftwbformcollection' => 'ZfTwitterBootstrap\Form\View\Helper\FormCollection',
            'zftwbformelementerrors' => 'ZfTwitterBootstrap\Form\View\Helper\FormElementErrors',
            'zftwbforminput' => 'ZfTwitterBootstrap\Form\View\Helper\FormInput',
            'zftwbformmulticheckbox' => 'ZfTwitterBootstrap\Form\View\Helper\FormMultiCheckbox',
            'zftwbformradio' => 'ZfTwitterBootstrap\Form\View\Helper\FormRadio',
            'zftwbformrow'  => 'ZfTwitterBootstrap\Form\View\Helper\FormRow',
            'zftwbformactions'  => 'ZfTwitterBootstrap\Form\View\Helper\FormActions',
            'zftwbformsearch' => 'ZfTwitterBootstrap\Form\View\Helper\FormSearch',
            'zftwbformtext' => 'ZfTwitterBootstrap\Form\View\Helper\FormText',
            'zftwbformtextarea' => 'ZfTwitterBootstrap\Form\View\Helper\FormTextarea',
                
            /**
             * Uncomment the lines below to override default Zend Form components
             */
            'form'  => 'ZfTwitterBootstrap\Form\View\Helper\Form',
            'formbutton' => 'ZfTwitterBootstrap\Form\View\Helper\FormButton',
            'formcheckbox' => 'ZfTwitterBootstrap\Form\View\Helper\FormCheckbox',
            'formcollection' => 'ZfTwitterBootstrap\Form\View\Helper\FormCollection',
            'formelementerrors' => 'ZfTwitterBootstrap\Form\View\Helper\FormElementErrors',
            'forminput' => 'ZfTwitterBootstrap\Form\View\Helper\FormInput',
            'formmulticheckbox' => 'ZfTwitterBootstrap\Form\View\Helper\FormMultiCheckbox',
            'formradio' => 'ZfTwitterBootstrap\Form\View\Helper\FormRadio',
            'formrow'  => 'ZfTwitterBootstrap\Form\View\Helper\FormRow',
            'formactions'  => 'ZfTwitterBootstrap\Form\View\Helper\FormActions',
            'formsearch' => 'ZfTwitterBootstrap\Form\View\Helper\FormSearch',
            'formtext' => 'ZfTwitterBootstrap\Form\View\Helper\FormText',
            'formtextarea' => 'ZfTwitterBootstrap\Form\View\Helper\FormTextarea',
        )     
    )
);
