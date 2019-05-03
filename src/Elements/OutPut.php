<?php

namespace Cajudev\Elements;

class OutPut extends Element
{
    const TAG_NAME  = 'output';
    const CLOSE_TAG = true;

    public function render(): string
    {
        return '';
    }
}