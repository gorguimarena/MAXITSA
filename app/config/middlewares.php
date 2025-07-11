<?php

use APP\CORE\ENUM\MiddlewareKey;
use APP\CORE\MIDDLEWARE\Auth;

$middlewares = [
    MiddlewareKey::AUTH->value => Auth::class 
];