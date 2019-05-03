<?php

namespace Cajudev\Elements;

use Cajudev\Interfaces\Renderable;

use Cajudev\Forms;

use Cajudev\Collections\ClassList;
use Cajudev\Collections\ChildList;
use Cajudev\Collections\AttrList;

abstract class Element implements Renderable
{
	private $parent;
	private $id;
	private $classlist;
	private $childlist;
	private $attrlist;

	public function __construct()
	{
		$this->classlist = new ClassList($this);
		$this->childlist = new ChildList($this);
		$this->attrlist  = new AttrList($this);
	}

	public function create(string $name)
	{
		return $this->append(Forms::create($name));
	}

	public function append(Element $element)
	{
		$element->parent($this);
		$this->childlist->attach($element);
		return $element;
	}

	public function remove(Element $element)
	{
		$this->childlist->detach($element);
		return $this;
	}

	public function contains(Element $element)
	{
		return $this->childlist->contains($element);
	}

	public function __get(string $property)
	{
		switch ($property) {
			case 'classlist':
				return $this->classlist;
			case 'childlist':
				return $this->childlist;
			case 'attrlist':
				return $this->attrlist;
		}
	}

	public function id(string $id = null)
	{
		if ($id === null) {
			return $this->id;
		}

		$this->id = $id;
		return $this;
	}

	public function parent(self $parent = null)
	{
		if ($parent === null) {
			return $this->parent;
		}

		$this->parent = $parent;
		return $this;
	}
}