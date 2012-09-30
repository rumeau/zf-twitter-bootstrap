<?php

namespace ZfTwitterBootstrap\Form\Element;

use ZfTwitterBootstrap\Form\Element;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\Uri as UriValidator;
use Zend\Validator\ValidatorInterface;

/**
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 */
class Url extends Element implements InputProviderInterface
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'url',
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
    public function getValidator()
    {
        if (null === $this->validator) {
            $this->validator = new UriValidator(array(
                'allowAbsolute' => true,
                'allowRelative' => false,
            ));
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
            ),
            'validators' => array(
                $this->getValidator(),
            ),
        );
    }
}
