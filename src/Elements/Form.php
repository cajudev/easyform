<?php

namespace Cajudev\Elements;

class Form extends Element
{
    const TAG_NAME  = 'form';
    const CLOSE_TAG = true;

    public function render(): string
    {
        return sprintf('<%1$s></%1$s>', self::TAG_NAME);
    }
}