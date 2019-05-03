<?php

namespace Cajudev\Interfaces;

interface ArrayList
{
	function add(string ...$data);
	function remove(string ...$data);
	function get(int $index);
	function contains(string $data);
	function reset();
}