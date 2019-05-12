<?php

namespace Cajudev\Interfaces;

interface Dictionary
{
	function add(string $name, string $value);
	function remove(string $index);
	function get(string $index);
	function reset();
	function count();
}