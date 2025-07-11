<?php
namespace APP\CORE\ENUM;

enum DependanceKey : string{
    case CONTROLLER = 'CONTROLLER';
    case SERVICE = 'SERVICE';
    case REPOSITORY = 'REPOSITORY';
    case CORE = 'CORE';
    case DATABASE = 'DATABASE';
    case MIDDLEWARE = 'MIDDLEWARE';
}