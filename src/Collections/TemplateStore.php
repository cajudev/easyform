<?php

namespace Cajudev\Collections;

use Cajudev\UI\Template;
use Cajudev\Interfaces\Store;

class TemplateStore implements Store
{
	private $templates;

	public function add(object ...$template)
	{
		foreach ($template as $t) {
			if (!$t instanceof Template) {
				throw new \InvalidArgumentException('Expect '.Template::class.' object, '.get_class($t).' given');
			}
			$this->templates[] = $t;
		}
		return $this;
	}

	public function get(string $name)
	{
		$template = array_values(array_filter($this->templates, function($template) use ($name) {
			return $template->getName() === $name;
		}));

		return isset($template[0]) ? $template[0]->getContent() : null;
	}
}