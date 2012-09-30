<?php

namespace ZfTwitterBootstrap\Form\Element;

use Traversable;
use ZfTwitterBootstrap\Form\Element;
use Zend\InputFilter\InputProviderInterface;
use Zend\Validator\Explode as ExplodeValidator;
use Zend\Validator\InArray as InArrayValidator;
use Zend\Validator\ValidatorInterface;

class Select extends Element
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'select',
    );

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @var array
     */
    protected $valueOptions = array();

    /**
     * @return array
     */
    public function getValueOptions()
    {
        return $this->valueOptions;
    }

    /**
     * @param  array $options
     * @return Select
     */
    public function setValueOptions(array $options)
    {
        $this->valueOptions = $options;
        return $this;
    }

    /**
     * Set options for an element. Accepted options are:
     * - label: label to associate with the element
     * - label_attributes: attributes to use when the label is rendered
     * - value_options: list of values and labels for the select options
     *
     * @param  array|\Traversable $options
     * @return Select|ElementInterface
     * @throws Exception\InvalidArgumentException
     */
    public function setOptions($options)
    {
        parent::setOptions($options);

        if (isset($this->options['value_options'])) {
            $this->setValueOptions($this->options['value_options']);
        }
        // Alias for 'value_options'
        if (isset($this->options['options'])) {
            $this->setValueOptions($this->options['options']);
        }

        return $this;
    }

    /**
     * Set a single element attribute
     *
     * @param  string $key
     * @param  mixed  $value
     * @return Select|ElementInterface
     */
    public function setAttribute($key, $value)
    {
        // Do not include the options in the list of attributes
        // TODO: Deprecate this
        if ($key === 'options') {
            $this->setValueOptions($value);
            return $this;
        }
        return parent::setAttribute($key, $value);
    }

    /**
     * Get validator
     *
     * @return ValidatorInterface
     */
    protected function getValidator()
    {
        if (null === $this->validator) {
            $validator = new InArrayValidator(array(
                'haystack' => $this->getValueOptionsValues(),
                'strict'   => false
            ));

            $multiple = (isset($this->attributes['multiple']))
                      ? $this->attributes['multiple'] : null;

            if (true === $multiple || 'multiple' === $multiple) {
                $validator = new ExplodeValidator(array(
                    'validator'      => $validator,
                    'valueDelimiter' => null, // skip explode if only one value
                ));
            }

            $this->validator = $validator;
        }
        return $this->validator;
    }

    /**
     * Provide default input rules for this element
     *
     * Attaches the captcha as a validator.
     *
     * @return array
     */
    public function getInputSpecification()
    {
        $spec = array(
            'name' => $this->getName(),
            'required' => true,
            'validators' => array(
                $this->getValidator()
            )
        );

        return $spec;
    }

    /**
     * Get only the values from the options attribute
     *
     * @return array
     */
    protected function getValueOptionsValues()
    {
        $values = array();
        $options = $this->getValueOptions();
        foreach ($options as $key => $optionSpec) {
            $value = (is_array($optionSpec)) ? $optionSpec['value'] : $key;
            $values[] = $value;
        }
        return $values;
    }
}
