<?php

namespace Cajudev\Collections;

class RecursiveWalker
{
    public static function walk(&$array, callable $callback)
    {
        foreach ($array as $key => $value) {
            is_array($value) ? self::walk($array[$key], $callback) : $callback($array, $key);
        }
    }
}