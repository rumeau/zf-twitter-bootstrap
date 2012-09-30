<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormInput as ZendFormInputHelper;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormInput extends ZendFormInputHelper
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
        $attributes['name']  = $name;
        $attributes['type']  = $this->getType($element);
        $attributes['value'] = $element->getValue();
        
        $type = $this->getType($element);
        $openAddonTag  = '';
        $closeAddonTag = '';
        $classAddon    = array();
        $appendText    = $element->getAppendText();
        $prependText   = $element->getPrependText();
        if (in_array(strtolower($type), $element->getValidAddonTypeElements())) {
            if (!empty($prependText)) {
                $prependText = '<span class="add-on">' . $element->getPrependText() . '</span>';
                $classAddon[] = 'input-prepend';
            }
            if (!empty($appendText)) {
                $appendText = '<span class="add-on">' . $element->getAppendText() . '</span>';
                $classAddon[] = 'input-append';
            }
            
            if (!empty($classAddon)) {
                $openAddonTag .= sprintf('<div %s>', $this->createAttributesString(array('class' => join(' ', $classAddon))));
                if (!empty($prependText)) {
                    $openAddonTag .= $prependText;
                }
                
                if (!empty($appendText)) {
                    $closeAddonTag .= $appendText;
                }
                $closeAddonTag .= '</div>';
            }
        }

        $input = sprintf(
            '<input %s%s',
            $this->createAttributesString($attributes),
            $this->getInlineClosingBracket()
        );
        
        return $openAddonTag . $input . $closeAddonTag;
    }
}
