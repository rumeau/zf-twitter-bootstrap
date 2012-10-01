<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use ZfTwitterBootstrap\Form\Element;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper as BaseAbstractHelper;

class FormActions extends BaseAbstractHelper
{
    /**
     * @var FormElement
     */
    protected $elementHelper;
    
    /**
     * Utility form helper that renders a form actions container
     *
     * @param array|ElementInterface $actions
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     */
    public function render($elements = array())
    {
        $markup = $this->openTag();
        
        $elementHelper  = $this->getElementHelper();
        
        if (is_array($elements) && count($elements)) {
            foreach ($elements as $element) {
                if (is_string($element)) {
                    $markup .= $element . "\n";
                } elseif ($element instanceof ElementInterface) {
                    $markup .= $elementHelper->render($element) . "\n";
                }
            }
        } elseif (is_string($elements)) {
            $markup .= $elements . "\n";
        } elseif ($elements instanceof ElementInterface) {
            $markup .= $elementHelper->render($element) . "\n";
        }
        
        $markup .= $this->closeTag();
    
        return $markup;
    }
    
    /**
     * Render the open tag of the row control group
     * 
     * @param ElementInterface
     * @return string
     */
    public function openTag()
    {
        $attributes = array(
            'class' => 'form-actions'
        );
        
        $tag = sprintf('<div %s>', $this->createAttributesString($attributes));
        return $tag;
    }
    
    /**
     * Render the colsing tag for the row control group
     * 
     * @return string
     */
    public function closeTag()
    {
        return '</div>';
    }
    
    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param null|ElementInterface $element
     * @param null|string           $labelPosition
     * @param bool                  $renderErrors
     * @return string|FormRow
     */
    public function __invoke($actions = array())
    {
        if (!count($actions)){
            return $this;
        }
    
        return $this->render($actions);
    }
    
    /**
     * Retrieve the FormElement helper
     *
     * @return FormElement
     */
    protected function getElementHelper()
    {
        if ($this->elementHelper) {
            return $this->elementHelper;
        }
    
        if (method_exists($this->view, 'plugin')) {
            $this->elementHelper = $this->view->plugin('form_element');
        }
    
        if (!$this->elementHelper instanceof FormElement) {
            $this->elementHelper = new FormElement();
        }
    
        return $this->elementHelper;
    }
}
