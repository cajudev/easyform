<?php

namespace Cajudev\Elements;

class OptGroup extends Element
{
    const TAG_NAME  = 'optgroup';
    const CLOSE_TAG = true;

    public function render(): string
    {
        return '';
    }
}