<?php

namespace ZfTwitterBootstrap\Form\Element;

use ZfTwitterBootstrap\Form\Element;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\DateStep as DateStepValidator;
use Zend\Validator\Regex as RegexValidator;
use Zend\Validator\ValidatorInterface;

class Month extends DateTime
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'month',
    );

    /**
     * Retrieves a Date Validator configured for a Month Input type
     *
     * @return ValidatorInterface
     */
    protected function getDateValidator()
    {
        return new RegexValidator('/^[0-9]{4}\-(0[1-9]|1[012])$/');
    }

    /**
     * Retrieves a DateStep Validator configured for a Month Input type
     *
     * @return ValidatorInterface
     */
    protected function getStepValidator()
    {
        $stepValue = (isset($this->attributes['step']))
                     ? $this->attributes['step'] : 1; // Months

        $baseValue = (isset($this->attributes['min']))
                     ? $this->attributes['min'] : '1970-01';

        return new DateStepValidator(array(
            'format'    => "Y-m",
            'baseValue' => $baseValue,
            'step'      => new \DateInterval("P{$stepValue}M"),
        ));
    }
}
