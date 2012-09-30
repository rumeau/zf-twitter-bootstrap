<?php

namespace ZfTwitterBootstrap\Form\Element;

use Zend\Validator\InArray as InArrayValidator;
use Zend\Validator\ValidatorInterface;

class Radio extends MultiCheckbox
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'radio'
    );

    /**
     * Get validator
     *
     * @return ValidatorInterface
     */
    protected function getValidator()
    {
        if (null === $this->validator) {
            $this->validator = new InArrayValidator(array(
                'haystack'  => $this->getValueOptionsValues(),
                'strict'    => false,
            ));
        }
        return $this->validator;
    }
}
