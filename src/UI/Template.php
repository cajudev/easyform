<?php

namespace Cajudev\UI;

class Template
{
    private $name;
    private $content;

    public function __construct(string $name, array $content)
    {
        $this->name    = $name;
        $this->content = $content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): array
    {
		return $this->content;
	}
}
