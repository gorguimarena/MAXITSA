<?php

namespace APP\CORE\MIDDLEWARE;

class Auth extends Middleware
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        if ($this->session->get('user') === null) {
            header('Location: /'); 
            exit; 
        }
    }
}
