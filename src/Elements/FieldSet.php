<?php

namespace Cajudev\Elements;

class FieldSet extends Element
{
    const TAG_NAME  = 'fieldset';
    const CLOSE_TAG = true;

    public function render(): string
    {
        return '';
    }
}