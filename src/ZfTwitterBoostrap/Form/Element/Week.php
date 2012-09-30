<?php

namespace ZfTwitterBootstrap\Form\Element;

use ZfTwitterBootstrap\Form\Element;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\DateStep as DateStepValidator;
use Zend\Validator\Regex as RegexValidator;
use Zend\Validator\ValidatorInterface;

class Week extends DateTime
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'week',
    );

    /**
     * Retrieves a Date Validator configured for a Week Input type
     *
     * @return ValidatorInterface
     */
    protected function getDateValidator()
    {
        return new RegexValidator('/^[0-9]{4}\-W[0-9]{2}$/');
    }

    /**
     * Retrieves a DateStep Validator configured for a Week Input type
     *
     * @return ValidatorInterface
     */
    protected function getStepValidator()
    {
        $stepValue = (isset($this->attributes['step']))
                     ? $this->attributes['step'] : 1; // Weeks

        $baseValue = (isset($this->attributes['min']))
                     ? $this->attributes['min'] : '1970-W01';

        return new DateStepValidator(array(
            'format'    => 'Y-\WW',
            'baseValue' => $baseValue,
            'step'      => new \DateInterval("P{$stepValue}W"),
        ));
    }
}
