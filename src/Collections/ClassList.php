<?php

namespace Cajudev\Collections;

use Cajudev\Interfaces\ArrayList;
use Cajudev\Interfaces\Renderable;

use Cajudev\Elements\Element;
use Cajudev\Util\Character;

class ClassList implements ArrayList, Renderable
{
    private $parent;
    private $classes = [];

    public function __construct(Element $parent = null)
    {
        $this->parent = $parent;
    }

    public function add(string ...$classes): self
    {
        $this->classes = array_merge($this->classes, $classes);
        return $this;
	}

    public function get(int $index)
    {
        return $this->classes[$index] ?? null;
	}

    public function remove(string ...$classes): self
    {
        $this->classes = array_values(array_diff($this->classes, $classes));
        return $this;
    }
    
    public function contains(string $name): bool
    {
        return in_array($name, $this->classes);
	}

    public function reset(): self
    {
        $this->classes = [];
        return $this;
    }
    
    public function count(): int
    {
        return count($this->classes);
	}

    public function render(): string
    {
        if (empty($this->classes)) {
            return '';
        }

        return 'class="'.implode(Character::SPACE, $this->classes).'"';
    }

	public function parent() {
		return $this->parent;
	}
}