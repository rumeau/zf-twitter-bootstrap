<?php

namespace ZfTwitterBootstrap\Form;

use Zend\Form\Form as ZendForm;

class Form extends ZendForm
{
    const FORM_LAYOUT_SEARCH = 'search';
    const FORM_LAYOUT_INLINE = 'inline';
    const FORM_LAYOUT_HORIZONTAL = 'horizontal';
    
    /**
     * @var string Form Layout
     */
    public $formLayout;
    
    /**
     * Sets the form layout
     * 
     * @param string
     * @return \ZfTwitterBootstrap\Form\Form
     */
    public function setFormLayout($formLayout)
    {
        $this->formLayout = $formLayout;
    }
    
    /**
     * Gets the form layout
     * 
     * @return string
     */
    public function getFormLayout()
    {
        if (!$this->formLayout) {
            return self::FORM_LAYOUT_HORIZONTAL;
        }
        
        return $this->formLayout;
    }
}