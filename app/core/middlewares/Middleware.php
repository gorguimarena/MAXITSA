<?php
namespace APP\CORE\MIDDLEWARE;

use APP\CORE\ABSTRACT\Singleton;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use APP\CORE\Session;

abstract class Middleware extends Singleton{
    protected ?Session $session = null;
    abstract public function __invoke();

    public function __construct(){
        $this->session =  App::getDependencie(DependanceKey::CORE, ClassKey::SESSION);    
    }
}