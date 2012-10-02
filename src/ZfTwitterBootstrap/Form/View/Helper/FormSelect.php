<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormSelect as ZendFormSelectHelper;
use Zend\Form\Element\Select as ZendSelectElement;
use ZfTwitterBootstrap\Form\Element\Select as SelectElement;
use Zend\Form\Exception;

class FormSelect extends ZendFormSelectHelper
{    
    /**
     * Render a form <select> element from the provided $element
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        if (!$element instanceof SelectElement && !$element instanceof ZendSelectElement) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s requires that the element is of type ZfTwitterBootstrap\Form\Element\Select or Zend\Form\Element\Select',
                __METHOD__
            ));
        }
        
        $name   = $element->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has an assigned name; none discovered',
                __METHOD__
            ));
        }
        
        $options = $element->getValueOptions();
        if (empty($options)) {
            throw new Exception\DomainException(sprintf(
                '%s requires that the element has "value_options"; none found',
                __METHOD__
            ));
        }
        
        $attributes = $element->getAttributes();
        $value      = $this->validateMultiValue($element->getValue(), $attributes);
    
        $attributes['name'] = $name;
        if (array_key_exists('multiple', $attributes) && $attributes['multiple']) {
            $attributes['name'] .= '[]';
        }
        $this->validTagAttributes = $this->validSelectAttributes;
    
        return sprintf(
            '<select %s>%s</select>',
            $this->createAttributesString($attributes),
            $this->renderOptions($options, $value)
        );
    }
}
