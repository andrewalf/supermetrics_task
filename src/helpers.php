<?php

if (!function_exists('dd')) {
    function dd() {
        array_map(fn ($v) => var_dump($v), func_get_args());
        die();
    }
}

if (!function_exists('env')) {
    function env(string $key, $defaultValue = null) {
        return $_ENV[$key] ?? $defaultValue;
    }
}