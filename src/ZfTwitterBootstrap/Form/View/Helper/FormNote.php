<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use ZfTwitterBootstrap\Form\Element\Note;
use Zend\I18n\Translator\Translator;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\ElementInterface;
use Zend\Form\Exception;

class FormNote extends AbstractHelper
{
    public function __invoke($element = null, $labelContent = null, $position = null)
    {
        if (!$element) {
            return $this;
        }
        
        if (is_string($element)) {
            $element = new Note(null, array('label' => $element));
        }

        $label   = '';
        if ($labelContent === null) {
            $label = $element->getLabel();
            if (empty($label)) {
                throw new Exception\DomainException(sprintf(
                    '%s expects either label content as the second argument, ' .
                    'or that the element provided has a label attribute; neither found',
                    __METHOD__
                    ));
            }
            
            if (null !== ($translator = $this->getTranslator())) {
                $label = $translator->translate(
                    $label, $this->getTranslatorTextDomain()
                );
            }
        }
        
        if ($label && $labelContent) {
            switch ($position) {
                case self::APPEND:
                    $labelContent .= $label;
                    break;
                case self::PREPEND:
                    default:
                        $labelContent = $label . $labelContent;
                        break;
            }
        }
        
        if ($label && null === $labelContent) {
            $labelContent = $label;
        }
        
        return $labelContent;
    }
}
