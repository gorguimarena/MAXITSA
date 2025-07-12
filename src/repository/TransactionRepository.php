<?php

namespace MAXITSA\REPOSITORY;

use APP\CORE\ABSTRACT\AbstractRepository;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use MAXITSA\ENTITY\Paiement;
use MAXITSA\ENTITY\Transfert;
use MAXITSA\ENTITY\TypeTransaction;
use PDO;

class TransactionRepository extends AbstractRepository
{
    private ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = App::getDependencie(DependanceKey::DATABASE, ClassKey::DATABASE)->getConnection();
    }

    public function getTransactionsByUserDefaultAccount(int $userId): array
    {
        $sql = "
            SELECT t.*
            FROM transaction t
            JOIN compte c ON c.id = t.id_compte_source
            WHERE c.id_utilisateur = :userId
              AND c.is_default = TRUE
            ORDER BY t.date_transaction DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['userId' => $userId]);

        $transactions = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            switch ($data['type_transaction']) {

                case 'TRANSFERT':
                    $transaction = Transfert::toObject($data);
                    break;
                case 'PAIEMENT':
                    $transaction = Paiement::toObject($data);
                    break;
                default:
                    continue 2;
            }
            $transactions[] = $transaction;
        }

        return $transactions;
    }

    public function findByCompte(int $compteId, array $data = []): array
    {
        $sql = "SELECT * FROM transaction 
            WHERE id_compte_source = :id OR id_compte_destination = :id 
            ORDER BY date_transaction DESC";

        $limit = isset($data['limit']) ? (int) $data['limit'] : 10;
        $offset = isset($data['offset']) ? (int) $data['offset'] : 0;

        $sql .= " LIMIT :limit OFFSET :offset";

        if (!empty($data['type'])) {
            $sql .= " AND type_transaction = :type";
        }
        if (!empty($data['date'])) {
            $sql .= " AND DATE(date_transaction) = :date";
        }


        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $compteId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        if (!empty($data['type'])) {
            $stmt->bindValue(':type', $data['type']);
        }
        if (!empty($data['date'])) {
            $stmt->bindValue(':date', $data['date']);
        }


        $stmt->execute();

        $transactions = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['type_transaction'] === TypeTransaction::TRANSFERT->value) {
                $transactions[] = Transfert::toObject($row);
            } elseif ($row['type_transaction'] === TypeTransaction::PAIEMENT->value) {
                $transactions[] = Paiement::toObject($row);
            }
        }

        return $transactions;
    }
}
