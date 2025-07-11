<?php

use APP\CORE\Router;

require_once '../app/config/bootstrap.php';

Router::setRoute($routes);

Router::resolve();


