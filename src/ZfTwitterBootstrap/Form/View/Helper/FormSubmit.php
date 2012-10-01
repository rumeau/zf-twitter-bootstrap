<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormSubmit as ZendFormSubmitHelper;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormSubmit extends ZendFormSubmitHelper
{
    /**
     * Render a form <input> element from the provided $element
     *
     * @param  ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $name = $element->getName();
        if ($name === null || $name === '') {
            throw new Exception\DomainException(sprintf(
                    '%s requires that the element has an assigned name; none discovered',
                    __METHOD__
            ));
        }
    
        $attributes          = $element->getAttributes();
        if (!array_key_exists('class', $attributes)) {
            $attributes['class'] = 'btn';
        } else {
            $attributes['class'] = 'btn ' . $attributes['class'];
        }
        $attributes['name']  = $name;
        $attributes['type']  = $this->getType($element);
        $attributes['value'] = $element->getValue();
    
        $type = $this->getType($element);
    
        return sprintf(
                '<input %s%s',
                $this->createAttributesString($attributes),
                $this->getInlineClosingBracket()
        );
    }
}
