<?php

namespace ZfTwitterBootstrap\Form\Element;

use ZfTwitterBootstrap\Form\Element;
use Zend\I18n\Validator\Float as NumberValidator;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\GreaterThan as GreaterThanValidator;
use Zend\Validator\LessThan as LessThanValidator;
use Zend\Validator\Step as StepValidator;
use Zend\Validator\ValidatorInterface;

class Number extends Element
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'number',
    );

    /**
     * @var array
     */
    protected $validators;

    /**
     * Get validator
     *
     * @return ValidatorInterface[]
     */
    protected function getValidators()
    {
        if ($this->validators) {
            return $this->validators;
        }

        $validators = array();
        $validators[] = new NumberValidator(array(
            'locale' => 'en_US', // HTML5 uses "100.01" format
        ));

        $inclusive = true;
        if (!empty($this->attributes['inclusive'])) {
            $inclusive = $this->attributes['inclusive'];
        }

        if (isset($this->attributes['min'])) {
            $validators[] = new GreaterThanValidator(array(
                'min' => $this->attributes['min'],
                'inclusive' => $inclusive
            ));
        }
        if (isset($this->attributes['max'])) {
            $validators[] = new LessThanValidator(array(
                'max' => $this->attributes['max'],
                'inclusive' => $inclusive
            ));
        }

        if (!isset($this->attributes['step'])
            || 'any' !== $this->attributes['step']
        ) {
            $validators[] = new StepValidator(array(
                'baseValue' => (isset($this->attributes['min']))  ? $this->attributes['min'] : 0,
                'step'      => (isset($this->attributes['step'])) ? $this->attributes['step'] : 1,
            ));
        }

        $this->validators = $validators;
        return $this->validators;
    }

    /**
     * Provide default input rules for this element
     *
     * Attaches a number validator, as well as a greater than and less than validators
     *
     * @return array
     */
    public function getInputSpecification()
    {
        return array(
            'name' => $this->getName(),
            'required' => true,
            'filters' => array(
                array('name' => 'Zend\Filter\StringTrim')
            ),
            'validators' => $this->getValidators(),
        );
    }
}
