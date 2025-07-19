<?php

namespace APP\CORE;

use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use APP\CORE\MIDDLEWARE\Auth;
use MAXITSA\CONTOLLER\CompteController;
use MAXITSA\CONTOLLER\SecurityController;
use MAXITSA\CONTOLLER\TransactionController;
use MAXITSA\CONTOLLER\UtilisateurController;
use MAXITSA\ENTITY\Transaction;
use MAXITSA\REPOSITORY\CompteRepository;
use MAXITSA\REPOSITORY\TransactionRepository;
use MAXITSA\REPOSITORY\UtilisateurRepository;
use MAXITSA\SERVICE\CompteService;
use MAXITSA\SERVICE\SecurityService;
use MAXITSA\SERVICE\TransactionService;
use MAXITSA\SERVICE\UtilisateurService;

class App
{

    private static array $dependencies = [
        DependanceKey::CONTROLLER->value => [
            ClassKey::COMPTE_CONTROLLER->value => CompteController::class,
            ClassKey::SECURITY_CONTROLLER->value => SecurityController::class,
            ClassKey::UTILISATEUR_CONTROLLER->value => UtilisateurController::class,
            ClassKey::TRANSACTION_CONTROLLER->value => TransactionController::class,
        ],
        DependanceKey::SERVICE->value => [
            ClassKey::COMPTE_SERVICE->value => CompteService::class,
            ClassKey::UTILISATEUR_SERVICE->value => UtilisateurService::class,
            ClassKey::SECURITY_SERVICE->value => SecurityService::class,
            ClassKey::TRANSACTION_SERVICE->value => TransactionService::class,
        ],
        DependanceKey::REPOSITORY->value => [
            ClassKey::COMPTE_REPOSITOTY->value => CompteRepository::class,
            ClassKey::UTILISATEUR_REPOSITOTY->value => UtilisateurRepository::class,
            ClassKey::TRANSACTION_REPOSITOTY->value => TransactionRepository::class,
        ],
        DependanceKey::CORE->value => [
            ClassKey::SESSION->value => Session::class
        ],

        DependanceKey::MIDDLEWARE->value => [
            ClassKey::AUTH_MIDDLEWARE->value => Auth::class
        ],
        DependanceKey::DATABASE->value => [
            ClassKey::DATABASE->value => Database::class
        ],
    ];

    public static function  getDependencie(DependanceKey $group, ClassKey $className): mixed
    {
        $groupeName = $group->value;
        if (array_key_exists($groupeName, self::$dependencies) && array_key_exists($className->value, self::$dependencies[$groupeName])) {
            if (!method_exists(self::$dependencies[$groupeName][$className->value], Env::get('METHODE_INSTANCE_NAME'))) {
                throw new \Exception("Error Processing Request", 1);
            }

            return self::$dependencies[$groupeName][$className->value]::getInstance();
        }
        return throw new \Exception("La dependance $className->value est null", 1);
    }
}
