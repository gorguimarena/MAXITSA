<?php

namespace MAXITSA\SERVICE;

use APP\CORE\ABSTRACT\Singleton;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use APP\CORE\Validator;
use MAXITSA\ENTITY\Client;
use MAXITSA\ENTITY\ServiceCommercial;
use MAXITSA\REPOSITORY\UtilisateurRepository;

class UtilisateurService extends Singleton
{
    private ?UtilisateurRepository $utilisateur_repository = null;
    private Validator $validator;

    public function __construct()
    {
        $this->utilisateur_repository = App::getDependencie(DependanceKey::REPOSITORY, ClassKey::UTILISATEUR_REPOSITOTY);
        $this->validator = new Validator();
    }

    public function cniExiste(string $cni): bool
    {
        return $this->utilisateur_repository->findByCni($cni);
    }

    public function login(string $login, string $password): Client | ServiceCommercial | null
    {

        if ($this->validator->isEmail('mail', $login)) {
            return $this->utilisateur_repository->selectByEmailAndPassword($login, $password);
        }

        if ($this->validator->isPhone('tel', $login)) {
            return $this->utilisateur_repository->selectByTelephoneAndPassword($login, $password);
        }

        return null;
    }
}
