<?php

namespace ZfTwitterBootstrap\Form\View\Helper;

use Zend\Form\View\Helper\FormSearch as ZendFormSearchHelper;

class FormSearch extends ZendFormSearchHelper
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = array(
            'type' => 'text',
    );
}
