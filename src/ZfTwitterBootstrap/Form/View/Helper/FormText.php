<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormText extends FormInput
{
    /**
     * Attributes valid for the input tag type="text"
     *
     * @var array
     */
    protected $validTagAttributes = array(
            'name'           => true,
            'autocomplete'   => true,
            'autofocus'      => true,
            'dirname'        => true,
            'disabled'       => true,
            'form'           => true,
            'list'           => true,
            'maxlength'      => true,
            'pattern'        => true,
            'placeholder'    => true,
            'readonly'       => true,
            'required'       => true,
            'size'           => true,
            'type'           => true,
            'value'          => true,
    );
    
    /**
     * Determine input type to use
     *
     * @param  ElementInterface $element
     * @return string
    */
    protected function getType(ElementInterface $element)
    {
        return 'text';
    }
}