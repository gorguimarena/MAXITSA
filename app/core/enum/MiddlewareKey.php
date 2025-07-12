<?php
namespace APP\CORE\ENUM;

enum MiddlewareKey : string {
    case AUTH = 'AUTH';
    case CRYPTER = 'CRYPTER';
}