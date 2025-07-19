<?php

namespace MAXITSA\REPOSITORY;

use APP\CORE\ABSTRACT\AbstractRepository;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use MAXITSA\ENTITY\Compte;
use PDO;

class CompteRepository extends AbstractRepository
{
    private ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = App::getDependencie(DependanceKey::DATABASE, ClassKey::DATABASE)->getConnection();
    }

    public function insert(Compte $compte): int
    {
        $sql = "INSERT INTO compte (numero_tel, solde, is_default, id_utilisateur)
            VALUES (:numero_tel, :solde, :is_default, :id_utilisateur)";

        $stmt = $this->pdo->prepare($sql);


        $stmt->bindValue(':numero_tel', $compte->getNumeroTel());
        $stmt->bindValue(':solde', $compte->getSolde());
        $stmt->bindValue(':is_default', $compte->isDefault(), PDO::PARAM_BOOL);
        $stmt->bindValue(':id_utilisateur', $compte->getClient()->getId());
        $stmt->execute();


        return (int) $this->pdo->lastInsertId();
    }

    public function findByTelephone(string $numero_tel): bool
    {
        $sql = "SELECT id FROM compte WHERE numero_tel = :tel";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['tel' => $numero_tel]);
        return $stmt->fetch() !== false;
    }

    public function findDefaultCompteByUserId(int $userId): ?Compte
    {
        $stmt = $this->pdo->prepare("
        SELECT c.*, u.id AS client_id
        FROM compte c
        JOIN utilisateur u ON u.id = c.id_utilisateur
        WHERE c.id_utilisateur = :userId AND c.is_default = TRUE
        LIMIT 1 ");
        $stmt->execute(['userId' => $userId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }
        $compte = Compte::toObject($data);
        return $compte;
    }

    public function debit(int $id_compte, float $montant): int
    {
        try {
            $query = "UPDATE compte SET solde = solde - :montant WHERE id = :id_compte";
            $stmt = $this->pdo->prepare($query);

            $stmt->execute([
                'montant' => $montant,
                'id_compte' => $id_compte
            ]);
        } catch (\PDOException $e) {
            return 0;
        }
        return 1;
    }

    public function crediter(int $id_compte, float $montant): int
    {
        try {
            $query = "UPDATE compte SET solde = solde + :montant WHERE id = :id_compte";
            $stmt = $this->pdo->prepare($query);

            $stmt->execute([
                'montant' => $montant,
                'id_compte' => $id_compte
            ]);
        } catch (\PDOException $e) {
            return 0;
        }
        return 1;
    }
}
