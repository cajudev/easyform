<?php

namespace Cajudev\Elements;

use Cajudev\Interfaces\Renderable;

use Cajudev\Util\Character;

use Cajudev\Collections\ClassList;
use Cajudev\Collections\ChildList;
use Cajudev\Collections\AttrList;

abstract class Element implements Renderable
{
	private $parent;
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
		switch (strtolower($name)) {
            case 'input':    return $this->append(new Input());
            case 'textarea': return $this->append(new TextArea());
            case 'label':    return $this->append(new Label());
            case 'fieldset': return $this->append(new FieldSet());
            case 'legend':   return $this->append(new Legend());
            case 'select':   return $this->append(new Select());
            case 'optgroup': return $this->append(new OptGroup());
            case 'option':   return $this->append(new Option());
            case 'button':   return $this->append(new Button());
            case 'dataList': return $this->append(new DataList());
            case 'output':   return $this->append(new OutPut());
            case 'small':    return $this->append(new Small());
            case 'text':     return $this->append(new Text());
        }
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
			case 'classlist': return $this->classlist;
			case 'childlist': return $this->childlist;
			case 'attrlist':  return $this->attrlist;
		}
	}

	public function parent(self $parent = null)
	{
		if ($parent === null) {
			return $this->parent;
		}

		$this->parent = $parent;
		return $this;
	}

	public function render(): string
	{
		$render  = Character::OPEN_TAG.static::TAG_NAME;

		if ($this->classlist->count() > 0) {
			$render .= Character::SPACE.$this->classlist->render();
		}

		if ($this->attrlist->count() > 0) {
			$render .= Character::SPACE.$this->attrlist->render();
		}

		$render .= Character::CLOSE_TAG;

		foreach ($this->childlist as $child) {
			$render .= $child->render();
		}
		
		$render .= Character::OPEN_TAG.Character::SLASH.static::TAG_NAME.Character::CLOSE_TAG;
		
		return $render;
	}
}