<?php

namespace Cajudev\EasyForm;

use Cajudev\Elements\Form;
use Cajudev\EasyForm\EasyInput;

class EasyForm
{
    private $form;
    private $styles = [];

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

    public function setStyle(string $key, string $value)
    {
        $this->styles[strtolower($key)] = $value;
    }

    public function input(array $params)
    {
       $easyInput = new EasyInput($this->form, $params, $this->styles);
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
