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
    private string $table = "compte";

    public function __construct()
    {
        $this->pdo = App::getDependencie(DependanceKey::DATABASE, ClassKey::DATABASE)->getConnection();
    }

    public function insert(Compte $compte): int
    {
        $sql = "INSERT INTO {$this->table} (numero_tel, solde, is_default, id_utilisateur)
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
        $sql = "SELECT id FROM {$this->table} WHERE numero_tel = :tel";
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
            $query = "UPDATE {$this->table} SET solde = solde - :montant WHERE id = :id_compte";
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
            $query = "UPDATE {$this->table} SET solde = solde + :montant WHERE id = :id_compte";
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

    public function selectByUserId(int $id_utilisateur): array
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE id_utilisateur = :id ORDER BY is_default DESC";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                'id' => $id_utilisateur
            ]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $comptes = [];
            if (!$res) {
                return [];
            }

            foreach ($res as $row) {
                $comptes[] = Compte::toObject($row);
            }

            return $comptes;
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function rendrePrincipal(int $id_utilisateur, int $id_compte): int
    {
        try {

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("UPDATE compte SET is_default = false WHERE id_utilisateur = :id_utilisateur");
            $stmt->execute(['id_utilisateur' => $id_utilisateur]);

            $stmt = $this->pdo->prepare("UPDATE compte SET is_default = true WHERE id = :id");
            $stmt->execute(['id' => $id_compte]);

            $this->pdo->commit();

            return 1;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            return 0;
        }
    }
}
