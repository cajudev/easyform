<?php

namespace Cajudev\Elements;

class Label extends Element
{
    const TAG_NAME  = 'label';
    const CLOSE_TAG = true;

    public function render(): string
    {
        return '';
    }
}