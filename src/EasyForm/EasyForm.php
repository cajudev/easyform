<?php

namespace Cajudev\EasyForm;

use Cajudev\Elements\Form;
use Cajudev\EasyForm\EasyInput;

class EasyForm
{
    private $form;
    private $style;

    public function __construct(array $params = [])
    {
        $this->form = new Form();

        if (isset($params['id'])) {
            $this->form->attrlist->add('id', $params['id']);
        }
        
        if (isset($params['action'])) {
            $this->form->attrlist->add('action', $params['action']);
        }

        if (isset($params['class'])) {
            $this->form->classlist->add($params['class']);
        }
    }

    public function setStyle(...$data)
    {
        if (is_array($data[0])) {
            $this->style = $data[0];
        } elseif (isset($data[0]) && isset($data[1])) {
            $this->style[$data[0]] = $data[1];
        }
    }

    public function input(array $params)
    {
       $easyInput = new EasyInput($this->form, $params, $this->style);
       $easyInput->create();
    }

    public function getForm()
    {
        return $this->form;
    }

    public function render()
    {
        return $this->form->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
