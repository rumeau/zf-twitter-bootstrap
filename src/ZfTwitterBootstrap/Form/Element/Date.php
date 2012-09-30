<?php

namespace ZfTwitterBootstrap\Form\Element;

use ZfTwitterBootstrap\Form\Element;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\Date as DateValidator;
use Zend\Validator\DateStep as DateStepValidator;
use Zend\Validator\ValidatorInterface;

class Date extends DateTime
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'date',
    );

    /**
     * Retrieves a Date Validator configured for a DateTime Input type
     *
     * @return ValidatorInterface
     */
    protected function getDateValidator()
    {
        return new DateValidator(array('format' => 'Y-m-d'));
    }

    /**
     * Retrieves a DateStep Validator configured for a Date Input type
     *
     * @return ValidatorInterface
     */
    protected function getStepValidator()
    {
        $stepValue = (isset($this->attributes['step']))
                     ? $this->attributes['step'] : 1; // Days

        $baseValue = (isset($this->attributes['min']))
                     ? $this->attributes['min'] : '1970-01-01';

        return new DateStepValidator(array(
            'format'    => 'Y-m-d',
            'baseValue' => $baseValue,
            'step'      => new \DateInterval("P{$stepValue}D"),
        ));
    }
}
