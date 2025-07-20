<?php

use APP\CORE\ENUM\KeyRoute;
use APP\CORE\ENUM\MiddlewareKey;
use MAXITSA\CONTOLLER\CompteController;
use MAXITSA\CONTOLLER\SecurityController;
use MAXITSA\CONTOLLER\TransactionController;
use MAXITSA\CONTOLLER\UtilisateurController;

$routes = [
    '/' => [
        KeyRoute::CONTROLLER->value => SecurityController::class,
        KeyRoute::ACTION->value => 'show',
        KeyRoute::MIDDLEWARES->value => []
    ],
    '/auth' => [
        KeyRoute::CONTROLLER->value => SecurityController::class,
        KeyRoute::ACTION->value => 'create',
        KeyRoute::MIDDLEWARES->value => []
    ],
    '/disconnect' => [
        KeyRoute::CONTROLLER->value => SecurityController::class,
        KeyRoute::ACTION->value => 'destroy',
        KeyRoute::MIDDLEWARES->value => []
    ],
    '/inscription/{n}' => [
        KeyRoute::CONTROLLER->value => SecurityController::class,
        KeyRoute::ACTION->value => 'inscript',
        KeyRoute::MIDDLEWARES->value => []
    ],
    '/inscription' => [
        KeyRoute::CONTROLLER->value => SecurityController::class,
        KeyRoute::ACTION->value => 'store',
        KeyRoute::MIDDLEWARES->value => []
    ],
    '/client/trans' => [
        KeyRoute::CONTROLLER->value => TransactionController::class,
        KeyRoute::ACTION->value => 'index',
        KeyRoute::MIDDLEWARES->value => [$middlewares[MiddlewareKey::AUTH->value]]
    ],
    '/client/add_account' => [
        KeyRoute::CONTROLLER->value => CompteController::class,
        KeyRoute::ACTION->value => 'create',
        KeyRoute::MIDDLEWARES->value => [$middlewares[MiddlewareKey::AUTH->value]]
    ],
    '/client/save_account' => [
        KeyRoute::CONTROLLER->value => CompteController::class,
        KeyRoute::ACTION->value => 'store',
        KeyRoute::MIDDLEWARES->value => [$middlewares[MiddlewareKey::AUTH->value]]
    ],
    '/client/comptes' => [
        KeyRoute::CONTROLLER->value => CompteController::class,
        KeyRoute::ACTION->value => 'index',
        KeyRoute::MIDDLEWARES->value => [$middlewares[MiddlewareKey::AUTH->value]]
    ],
    '/client/compte/rendre-principal/{id}' => [
        KeyRoute::CONTROLLER->value => CompteController::class,
        KeyRoute::ACTION->value => 'update_compte',
        KeyRoute::MIDDLEWARES->value => [$middlewares[MiddlewareKey::AUTH->value]]
    ],

    //service commercial
    '/service_commercial/trans' => [
        KeyRoute::CONTROLLER->value => TransactionController::class,
        KeyRoute::ACTION->value => 'index',
        KeyRoute::MIDDLEWARES->value => [$middlewares[MiddlewareKey::AUTH->value]]
    ]
];
