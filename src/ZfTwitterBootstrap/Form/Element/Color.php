<?php

namespace ZfTwitterBootstrap\Form\Element;

use ZfTwitterBootstrap\Form\Element;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\Regex as RegexValidator;
use Zend\Validator\ValidatorInterface;

class Color extends Element
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'color',
    );

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Get validator
     *
     * @return ValidatorInterface
     */
    protected function getValidator()
    {
        if (null === $this->validator) {
            $this->validator = new RegexValidator('/^#[0-9a-fA-F]{6}$/');
        }
        return $this->validator;
    }

    /**
     * Provide default input rules for this element
     *
     * Attaches an email validator.
     *
     * @return array
     */
    public function getInputSpecification()
    {
        return array(
            'name' => $this->getName(),
            'required' => true,
            'filters' => array(
                array('name' => 'Zend\Filter\StringTrim'),
                array('name' => 'Zend\Filter\StringToLower'),
            ),
            'validators' => array(
                $this->getValidator(),
            ),
        );
    }
}
