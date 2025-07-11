<?php

namespace MAXITSA\REPOSITORY;

use APP\CORE\ABSTRACT\AbstractRepository;
use APP\CORE\ABSTRACT\Singleton;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use MAXITSA\ENTITY\Client;
use MAXITSA\ENTITY\ServiceCommercial;
use PDO;
use MAXITSA\ENTITY\TypeUser;

class UtilisateurRepository extends AbstractRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = App::getDependencie(DependanceKey::DATABASE, ClassKey::DATABASE)->getConnection();
    }

    public function selectByEmailAndPassword(string $email, string $password): Client | ServiceCommercial | null
    {

        $stmt =  $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data && password_verify($password, $data['password'])) {
            return match ($data['type']) {
                TypeUser::CLIENT->value => Client::toObject($data),
                TypeUser::SERVICE_COMMERCIAL->value => ServiceCommercial::toObject($data),
                default => null
            };
        }

        return null;
    }

    public function selectByTelephoneAndPassword(string $tel, string $password): Client | ServiceCommercial | null
    {
        $stmt = $this->pdo->prepare("
        SELECT u.*
        FROM utilisateur u
        JOIN compte c ON c.id_utilisateur = u.id
        WHERE c.numero_tel = :tel AND c.is_default = TRUE
        LIMIT 1
        ");
        $stmt->execute(['tel' => $tel]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        

        if ($data && password_verify($password, $data['password'])) {
            return match ($data['type']) {
                TypeUser::CLIENT->value => Client::toObject($data),
                TypeUser::SERVICE_COMMERCIAL->value => ServiceCommercial::toObject($data),
                default => null
            };
        }

        return null;
    }

    public function insert(Client $client): int
    {
        $sql = "INSERT INTO utilisateur (nom, prenom, password, type, adresse, cni, cni_recto, cni_verso)
        VALUES (:nom, :prenom, :password, :type, :adresse, :cni, :cni_recto, :cni_verso)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':nom' => $client->getNom(),
            ':prenom' => $client->getPrenom(),
            ':password' => $client->getPassword(),
            ':type' => $client->getTypeUser()->value,
            ':adresse' => $client->getAdresse(),
            ':cni' => $client->getCni(),
            ':cni_recto' => $client->getCniRecto(),
            ':cni_verso' => $client->getCniVerso()
        ]);


        return (int) $this->pdo->lastInsertId();
    }

    public function findByCni(string $cni): bool
    {
        $sql = "SELECT id FROM utilisateur WHERE cni = :cni";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cni' => $cni]);
        return $stmt->fetch() !== false;
    }
}
