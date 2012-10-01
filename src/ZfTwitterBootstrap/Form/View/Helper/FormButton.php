<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormButton as ZendFormButtonHelper;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormButton extends ZendFormButtonHelper
{
    /**
     * Generate an opening button tag
     *
     * @param  null|array|ElementInterface $attributesOrElement
     * @return string
     */
    public function openTag($attributesOrElement = null)
    {
        if (null === $attributesOrElement) {
            return '<button>';
        }
    
        if (is_array($attributesOrElement)) {
            if (!array_key_exists('class', $attributesOrElement)) {
                $attributesOrElement['class'] = 'btn';
            } else {
                $attributesOrElement['class'] = 'btn ' . $attributesOrElement['class'];
            }
            $attributes = $this->createAttributesString($attributesOrElement);
            return sprintf('<button %s>', $attributes);
        }
    
        if (!$attributesOrElement instanceof ElementInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                    '%s expects an array or Zend\Form\ElementInterface instance; received "%s"',
                    __METHOD__,
                    (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))
            ));
        }
    
        $element = $attributesOrElement;
        $name    = $element->getName();
        if (empty($name) && $name !== 0) {
            throw new Exception\DomainException(sprintf(
                    '%s requires that the element has an assigned name; none discovered',
                    __METHOD__
            ));
        }
    
        $attributes          = $element->getAttributes();
        if (!array_key_exists('class', $attributes)) {
            $attributes['class'] = 'btn';
        } else {
            $attributes['class'] = 'btn ' . $attributes['class'];
        }
        $attributes['name']  = $name;
        $attributes['type']  = $this->getType($element);
        $attributes['value'] = $element->getValue();
    
        return sprintf(
                '<button %s>',
                $this->createAttributesString($attributes)
        );
    }
    
    /**
     * Render a form <button> element from the provided $element,
     * using content from $buttonContent or the element's "label" attribute
     *
     * @param  ElementInterface $element
     * @param  null|string $buttonContent
     * @return string
     */
    public function render(ElementInterface $element, $buttonContent = null)
    {
        $openTag = $this->openTag($element);

        if (null === $buttonContent) {
            $buttonContent = $element->getLabel();
            if (null === $buttonContent) {
                throw new Exception\DomainException(sprintf(
                    '%s expects either button content as the second argument, ' .
                    'or that the element provided has a label value; neither found',
                    __METHOD__
                ));
            }

            if (null !== ($translator = $this->getTranslator())) {
                $buttonContent = $translator->translate(
                    $buttonContent, $this->getTranslatorTextDomain()
                );
            }
        }

        $escape = $this->getEscapeHtmlHelper();

        return $openTag . $escape($buttonContent) . $this->closeTag();
    }
}
