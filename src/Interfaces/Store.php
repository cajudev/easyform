<?php

namespace Cajudev\Interfaces;

interface Store
{
	function add(object $object);
	function get(string $name);
}