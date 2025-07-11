<?php

namespace APP\CORE\MIDDLEWARE;

class Crypter extends Middleware
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        if (!empty($_POST['password']) && is_string($_POST['password'])) {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        
    }
}

