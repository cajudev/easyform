<?php

namespace Cajudev\Collections;

use Cajudev\UI\Template;
use Cajudev\Interfaces\Store;

class TemplateStore implements Store
{
	private $templates;

	public function add(object $template)
	{
		if (!$template instanceof Template) {
			throw new \InvalidArgumentException('Expect '.Template::class.' object, '.get_class($template).' given');
		}

		$this->templates[] = $template;
		return $this;
	}

	public function get(string $name)
	{
		return array_filter($this->templates, function($template) use ($name) {
			return $template->getName() === $name;
		})[0]->getContent();
	}
}