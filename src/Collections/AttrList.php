<?php

namespace Cajudev\Collections;

use Cajudev\Interfaces\Dictionary;
use Cajudev\Interfaces\Renderable;

use Cajudev\Elements\Element;
use Cajudev\Util\Character;

class AttrList implements Dictionary, Renderable
{
    private $parent;
    private $attributes = [];

    public function __construct(Element $parent = null)
    {
        $this->parent = $parent;
    }

    public function add(string $name, $value = null): self
    {
        if ($value === null) {
            $this->attributes[] = $value;
        } else {
            $this->attributes[$name] = $value;
        }
        return $this;
	}

    public function get(string $name)
    {
        return $this->attributes[$name] ?? null;
	}

    public function remove(string $name): self
    {
        unset($this->attributes[$name]);
        return $this;
	}

    public function reset(): self
    {
        $this->attributes = [];
        return $this;
    }
    
    public function count(): int
    {
        return count($this->attributes);
	}

    public function render(): string
    {
        if (empty($this->attributes)) {
            return '';
        }
        
        return implode(Character::SPACE, array_map(function ($name, $value) {
                return is_numeric($name) ? $value : "{$name}=\"$value\"";
            }, array_keys($this->attributes), $this->attributes));
    }

    public function parent() {
		return $this->parent;
	}
}