<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormRow as ZendFormRow;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormRow extends ZendFormRow
{
    /**
     * Utility form helper that renders a label (if it exists), an element and errors
     *
     * @param ElementInterface $element
     * @return string
     * @throws \Zend\Form\Exception\DomainException
     */
    public function render(ElementInterface $element)
    {
        $escapeHtmlHelper    = $this->getEscapeHtmlHelper();
        $labelHelper         = $this->getLabelHelper();
        $elementHelper       = $this->getElementHelper();
        $elementErrorsHelper = $this->getElementErrorsHelper();
    
        $label           = $element->getLabel();
        $inputErrorClass = $this->getInputErrorClass();
        $elementErrors   = $elementErrorsHelper->render($element);
    
        // Does this element have errors ?
        if (!empty($elementErrors) && !empty($inputErrorClass)) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class') . ' ' : '');
            $classAttributes = $classAttributes . $inputErrorClass;
    
            $element->setAttribute('class', $classAttributes);
        }
    
        $elementString = $elementHelper->render($element);
    
        $markup = $this->openTag($element);
        
        if (!empty($label)) {
            $label = $escapeHtmlHelper($label);
            $labelAttributes = $element->getLabelAttributes();
            $labelAttributes = is_null($labelAttributes) ? array() : $labelAttributes;
            if (array_key_exists('class', $labelAttributes) && !empty($labelAttributes['class'])) {
                $labelAttributes['class'] .= ' ';
            }
            $labelAttributes['class'] = 'control-label';
            
            $labelOpen  = $labelHelper->openTag($labelAttributes);
            $labelClose = $labelHelper->closeTag();
            
            $markup .= $labelOpen . $label . $labelClose . '<div class="controls">' . $elementString;
            
            if ($this->renderErrors) {
                $markup .= $elementErrors;
            }
            
            $markup .= '</div>';
        } else {
            if ($this->renderErrors) {
                $markup .= $elementString . $elementErrors;
            } else {
                $markup .= $elementString;
            }
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
    public function openTag(ElementInterface $element)
    {
        $attributes = array(
            'class' => 'control-group'
        );
        
        $elementErrorsHelper = $this->getElementErrorsHelper();
        $inputErrorClass = $this->getInputErrorClass();
        $elementErrors   = $elementErrorsHelper->render($element);
        
        // Does this element have errors ?
        if (!empty($elementErrors) && !empty($inputErrorClass)) {
            $attributes['class'] .= ' error';
        }
        
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
}