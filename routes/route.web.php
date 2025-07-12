<?php
use APP\CORE\ENUM\KeyRoute;
use APP\CORE\ENUM\MiddlewareKey;
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
    '/service_commercial/trans' => [
        KeyRoute::CONTROLLER->value => TransactionController::class,
        KeyRoute::ACTION->value => 'index',
        KeyRoute::MIDDLEWARES->value => [$middlewares[MiddlewareKey::AUTH->value]]
    ]
];

