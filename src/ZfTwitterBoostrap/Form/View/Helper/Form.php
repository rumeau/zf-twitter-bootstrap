<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use ZfTwitterBootstrap\Form\Form as FormInstance;
use Zend\Form\View\Helper\Form as ZendFormHelper;
use Zend\Form\FormInterface;

class Form extends ZendFormHelper
{
    /**
     * Generate an opening form tag
     *
     * @param  null|FormInterface $form
     * @return string
     */
    public function openTag(FormInterface $form = null)
    {
        $attributes = array(
            'action' => '',
            'method' => 'get'
        );
        
        if ($form instanceof FormInterface) {
            $formAttributes = $form->getAttributes();
            
            if (array_key_exists('class', $formAttributes) && !empty($formAttributes['class'])) {
                $formAttributes['class'] = $formAttributes['class'] . ' ';
            } else {
                $formAttributes['class'] = '';
            }
            
            switch ($form->getFormLayout()) {
                case FormInstance::FORM_LAYOUT_SEARCH :
                    $formAttributes['class'] .= 'form-search';
                    break;
                case FormInstance::FORM_LAYOUT_INLINE :
                    $formAttributes['class'] .= 'form-inline';
                    break;
                case FormInstance::FORM_LAYOUT_HORIZONTAL :
                default :
                    $formAttributes['class'] .= 'form-horizontal';
                    break;
            }
            
            if (!array_key_exists('id', $formAttributes) && array_key_exists('name', $formAttributes)) {
                $formAttributes['id'] = $formAttributes['name'];
            }
            $attributes = array_merge($attributes, $formAttributes);
        }

        $tag = sprintf('<form %s>', $this->createAttributesString($attributes));
        return $tag;
    }
}
