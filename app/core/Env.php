<?php
namespace APP\CORE;


class Env {
    public static function get(string $key, $default = null) {
        return $_ENV[$key] ?? $default;
    }
}
