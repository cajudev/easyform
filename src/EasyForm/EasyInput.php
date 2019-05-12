<?php

namespace Cajudev\EasyForm;

use Cajudev\Forms;

class EasyInput
{
    const TYPES = [
        'button', 'checkbox', 'color',  'date',  'datetime-local',
        'email',  'file',     'hidden', 'image', 'month',
        'number', 'password', 'radio',  'range', 'reset',
        'search', 'submit',   'tel',    'text',  'time',
        'url',    'week',
    ];

    private $form;
    private $params;
    private $styles;

    public function __construct($form, array $params, array $styles)
    {
        $this->form   = $form;
        $this->params = $this->validateParams($params);
        $this->styles = $styles;
    }

    public function create()
    {
        $fieldset = $this->createFieldset();
        $this->createLabel($fieldset);
        $this->createInput($fieldset);
        $this->createSmall($fieldset);
    }

    public function validateParams(array $params)
    {
        $params = array_change_key_case($params);
        if (empty($params['id'])) {
            throw new \InvalidArgumentException('Parâmetros id é obrigatório');
        }
        if (empty($params['type'])) {
            throw new \InvalidArgumentException('Parâmetros type é obrigatório');
        }
        if (!in_array($params['type'], self::TYPES)) {
            throw new \InvalidArgumentExceptiontion('Parâmetro type inválido');
        }
        return $params;
    }

    public function createFieldset()
    {
        if (empty($this->params['label']) && isset($this->params['small']))  {
            return null;
        }

        $fieldset = $this->form->create('fieldset');
        if (isset($this->styles['fieldset'])) {
            $fieldset->classlist->add($this->styles['fieldset']);
        }

        return $fieldset;
    }

    public function createLabel($fieldset)
    {
        if ($fieldset === null || empty($this->params['label'])) {
            return null;
        }

        $label = $fieldset->create('label');

        if (isset($this->styles['label'])) {
            $label->classlist->add($this->styles['label']);
        }

        $label->attrlist->add('for', $this->params['id']);
        $label->create('text')->textContent($this->params['label']);
    }

    public function createInput($fieldset)
    {
        if ($fieldset === null) {
            $input = $this->form->create('input');
        } else {
            $input = $fieldset->create('input');
        }
        
        if (isset($this->styles['input'])) {
            $input->classlist->add($this->styles['input']);
        }

        if (isset($this->params['class'])) {
            $input->classlist->add($this->params['class']);
        }

        $input->attrlist->add('id', $this->params['id'])
                        ->add('type', $this->params['type']);
    }

    public function createSmall($fieldset)
    {
        if ($fieldset === null || empty($this->params['small'])) {
            return null;
        }

        $small = $fieldset->create('small');

        if (isset($this->styles['small'])) {
            $small->classlist->add($this->styles['small']);
        }

        $small->create('text')->textContent($this->params['small']);
    }
}

