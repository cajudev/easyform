<?php

namespace Cajudev\Elements;

use Cajudev\Util\Character;

class SelfClosingElement extends Element
{
    public function render(): string
	{
		$render  = Character::OPEN_TAG.static::TAG_NAME;

		if ($this->classlist->count() > 0) {
			$render .= Character::SPACE.$this->classlist->render();
		}

		if ($this->attrlist->count() > 0) {
			$render .= Character::SPACE.$this->attrlist->render();
		}

		$render .= Character::SLASH.Character::CLOSE_TAG;

		return $render;
	}
}