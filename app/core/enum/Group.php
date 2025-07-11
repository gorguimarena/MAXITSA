<?php
namespace APP\CORE\ENUM;

enum Group : string {
    case SERVICE = 'SERVICE';
    case REPOSITORY = 'REPOSITORY';
    case CONTROLLER = 'CONTROLLER';
}