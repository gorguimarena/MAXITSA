<?php

use APP\CORE\ENUM\MiddlewareKey;
use APP\CORE\MIDDLEWARE\Auth;
use APP\CORE\MIDDLEWARE\Crypter;

$middlewares = [
    MiddlewareKey::AUTH->value => Auth::class,
    MiddlewareKey::CRYPTER->value => Crypter::class
];