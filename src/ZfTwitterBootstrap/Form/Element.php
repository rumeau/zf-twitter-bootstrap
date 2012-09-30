<?php

namespace ZfTwitterBootstrap\Form;

use Traversable;
use Zend\Stdlib\ArrayUtils;
use Zend\Form\Element as ZendElement;
use Zend\Form\Exception;

class Element extends ZendElement
{
    /**
     * @var array Valid elements accepting add-on
     */
    protected $validAddonTypeElements = array(
        'text',
        'password',
        'color',
        'date',
        'date-time',
        'datetime-local',
        'email',
        'month',
        'number',
        'password',
        'range',
        'time',
        'url',
        'week'
    );
    
    /**
     * @var string
     */
    protected $appendText;
    
    /**
     * @var string
     */
    protected $prependText;
    
    /**
     * Set options for an element. Accepted options are:
     * - label: label to associate with the element
     * - label_attributes: attributes to use when the label is rendered
     *
     * @param  array|\Traversable $options
     * @return Element|ElementInterface
     * @throws Exception\InvalidArgumentException
     */
    public function setOptions($options)
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (!is_array($options)) {
            throw new Exception\InvalidArgumentException(
                    'The options parameter must be an array or a Traversable'
            );
        }
    
        if (isset($options['label'])) {
            $this->setLabel($options['label']);
        }
    
        if (isset($options['label_attributes'])) {
            $this->setLabelAttributes($options['label_attributes']);
        }
        
        $type = strtolower($this->attributes['type']);
        if (isset($options['prepend_text']) && in_array($type, $this->validAddonTypeElements)) {
            $this->setPrependText($options['prepend_text']);
        }
        
        if (isset($options['append_text']) && in_array($type, $this->validAddonTypeElements)) {
            $this->setAppendText($options['append_text']);
        }
    
        $this->options = $options;
    
        return $this;
    }
    
    /**
     * Get the valid type elements wich accepts Add-on option
     * 
     * @return array
     */
    public function getValidAddonTypeElements()
    {
        return $this->validAddonTypeElements;
    }
    
    /**
     * Set append text to the element
     *
     * @param string
     * @return Element
     */
    public function setAppendText($text = '')
    {
        $this->appendText = $text;
    
        return $this;
    }
    
    /**
     * Get appended text
     *
     * @return string
     */
    public function getAppendText()
    {
        return $this->appendText;
    }
    
    /**
     * Set prepend text to the element
     * 
     * @param string
     * @return Element
     */
    public function setPrependText($text = '')
    {
        $this->prependText = $text;
        
        return $this;
    }
    
    /**
     * Get prepended text
     * 
     * @return string
     */
    public function getPrependText()
    {
        return $this->prependText;
    }
}