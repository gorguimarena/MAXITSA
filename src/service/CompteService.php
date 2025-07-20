<?php

namespace MAXITSA\SERVICE;

use APP\CORE\ABSTRACT\Singleton;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use MAXITSA\ENTITY\Compte;
use MAXITSA\REPOSITORY\CompteRepository;
use MAXITSA\REPOSITORY\UtilisateurRepository;
use PDO;

class CompteService extends Singleton
{
    private ?PDO $pdo;
    private ?CompteRepository $compte_repository = null;
    private ?UtilisateurRepository $utilisateur_repository = null;

    public function __construct()
    {
        $this->pdo = App::getDependencie(DependanceKey::DATABASE, ClassKey::DATABASE)->getConnection();
        $this->compte_repository = App::getDependencie(DependanceKey::REPOSITORY, ClassKey::COMPTE_REPOSITOTY);
        $this->utilisateur_repository = App::getDependencie(DependanceKey::REPOSITORY, ClassKey::UTILISATEUR_REPOSITOTY);
    }

    public function createCompte(Compte $compte): bool
    {
        try {
            $this->pdo->beginTransaction();

            $client = $compte->getClient();
            $id = $this->utilisateur_repository->insert($client);

            if (!$id) {
                throw new \PDOException("Échec de l'insertion du client");
            }

            $client->setId($id);
            $compte->setClient($client);

            $compteId = $this->compte_repository->insert($compte);

            if (!$compteId) {
                throw new \PDOException("Échec de l'insertion du compte");
            }

            $this->pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function compteExiste(string $numero_tel): bool
    {
        return $this->compte_repository->findByTelephone($numero_tel);
    }

    public function getDefaultCompteByUtilisateur(string $userId): ?Compte
    {
        return $this->compte_repository->findDefaultCompteByUserId($userId);
    }

    public function createSecond(Compte $c) : int {
        return $this->compte_repository->insert($c);
    }

    public function get_comptes(int $id) : array {
        return $this->compte_repository->selectByUserId($id);
    }

    public function compte_to_principale(int $id_compte, int $id_user) : int {
        return $this->compte_repository->rendrePrincipal($id_user,$id_compte);
    }
}
