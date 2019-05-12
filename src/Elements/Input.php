<?php

namespace Cajudev\Elements;

use Cajudev\Util\Character;

class Input extends Element
{
    const TAG_NAME  = 'input';

    public function render(): string
	{
		$render  = Character::OPEN_TAG.static::TAG_NAME.Character::SPACE;

		if ($this->classlist->count() > 0) {
			$render .= $this->classlist->render().Character::SPACE;
		}

		if ($this->attrlist->count() > 0) {
			$render .= $this->attrlist->render().Character::SLASH.Character::CLOSE_TAG;
		}

		return $render;
	}
}