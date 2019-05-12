<?php

namespace Cajudev\EasyForm;

use Cajudev\Elements\Form;
use Cajudev\EasyForm\EasyInput;

class EasyForm
{
    private $form;
    private $styles = [];

    public function __construct()
    {
        $this->form = new Form();
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
