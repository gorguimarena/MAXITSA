<?php

namespace APP\CORE;

use APP\CORE\ABSTRACT\Singleton;

class Session extends Singleton
{

    public function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(string $key, mixed $value): void
    {
        $this->start();
        $_SESSION[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $this->start();
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        $this->start();
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        $this->start();
        unset($_SESSION[$key]);
    }

    public function destroy(): void
    {
        $this->start();
        
        $_SESSION = [];
        session_unset();
        session_destroy();
    }

    public function all(): array
    {
        $this->start();
        return $_SESSION;
    }
}
