<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormLinkButton extends FormInput
{
    /**
     * Attributes valid for the link button tag
     *
     * @var array
     */
    protected $validTagAttributes = array(
        'charset'  => true,
        'coords'   => true,
        'href'     => true,
        'hreflang' => true,
        'media'    => true,
        'name'     => true,
        'rel'      => true,
        'rev'      => true,
        'shape'    => true,
        'target'   => true,
        'mimetype' => true,
    );

    /**
     * Generate an opening link button tag
     *
     * @param  null|array|ElementInterface $attributesOrElement
     * @return string
     */
    public function openTag($attributesOrElement = null)
    {
        if (null === $attributesOrElement) {
            return '<a>';
        }

        if (is_array($attributesOrElement)) {
            if (!array_key_exists('class', $attributesOrElement)) {
                $attributesOrElement['class'] = 'btn';
            } else {
                $attributesOrElement['class'] = 'btn ' . $attributesOrElement['class'];
            }
            $attributes = $this->createAttributesString($attributesOrElement);
            return sprintf('<a %s>', $attributes);
        }

        if (!$attributesOrElement instanceof ElementInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects an array or Zend\Form\ElementInterface instance; received "%s"',
                __METHOD__,
                (is_object($attributesOrElement) ? get_class($attributesOrElement) : gettype($attributesOrElement))
            ));
        }

        $element = $attributesOrElement;

        $attributes          = $element->getAttributes();
        if (!array_key_exists('class', $attributes)) {
            $attributes['class'] = 'btn';
        } else {
            $attributes['class'] = 'btn ' . $attributes['class'];
        }
        
        // Remove type attribute for a elements
        if (array_key_exists('type', $attributes)) {
            unset($attributes['type']);
        }
        
        // Remove name attribute for a elements
        if (array_key_exists('name', $attributes)) {
            unset($attributes['name']);
        }
        
        // Use mimetype as an alias for type attribute
        if (array_key_exists('mimetype', $attributes)) {
            $attributes['type'] = $attributes['mimetype'];
            unset($attributes['mimetype']);
        }
        
        // Use anchor_name as an alias for type attribute
        if (array_key_exists('anchor_name', $attributes)) {
            $attributes['name'] = $attributes['anchor_name'];
            unset($attributes['anchor_name']);
        }

        return sprintf(
            '<a %s>',
            $this->createAttributesString($attributes)
        );
    }

    /**
     * Return a closing button tag
     *
     * @return string
     */
    public function closeTag()
    {
        return '</a>';
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

    /**
     * Invoke helper as functor
     *
     * Proxies to {@link render()}.
     *
     * @param  ElementInterface|null $element
     * @param  null|string $buttonContent
     * @return string|FormButton
     */
    public function __invoke(ElementInterface $element = null, $buttonContent = null)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element, $buttonContent);
    }
}
