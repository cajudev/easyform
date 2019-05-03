<?php

namespace Cajudev\Elements;

class Text extends Element
{
    const TAG_NAME  = 'text';

    private $textContent;

    public function render(): string
    {
        return '';
    }

    public function textContent(string $textContent = null) {
        if ($textContent === null) {
            return $this->textContent;
        }
        $this->textContent = $textContent;
        return $this;
    }
}