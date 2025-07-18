<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use APP\CORE\Env;

$dotenv = Dotenv::createImmutable('./');
$dotenv->load();

$dsn = Env::get('DRIVE') . ':host=' . Env::get('DB_HOST') . ';port=' . Env::get('DB_PORT') . ';dbname=' . Env::get('DB_NAME');

$pdo = new PDO(
    $dsn,
    Env::get('DB_USER'),
    Env::get('DB_PASSWORD')
);

try {
    $pdo->beginTransaction();

    $pdo->query("INSERT INTO utilisateur (nom, prenom, password, type, adresse, cni, cni_recto, cni_verso) VALUES
        ('Dupont', 'Jean', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CLIENT', '12 Rue de Paris, 75001', '1234567890', 'dupont_recto.jpg', 'dupont_verso.jpg'),
        ('Martin', 'Sophie', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CLIENT', '34 Avenue des Champs, 75008', '0987654321', 'martin_recto.jpg', 'martin_verso.jpg'),
        ('Bernard', 'Pierre', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CLIENT', '56 Boulevard Saint-Germain, 75005', '1122334455', 'bernard_recto.jpg', 'bernard_verso.jpg');
        ");

    $pdo->query("INSERT INTO utilisateur (nom, prenom, password, email, type) VALUES
        ('Leroy', 'Alice', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'a.leroy@maxitsa.com', 'SERVICE_COMMERCIAL'),
        ('Petit', 'Thomas', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 't.petit@maxitsa.com', 'SERVICE_COMMERCIAL')");

    $pdo->query("INSERT INTO compte (numero_tel, solde, is_default, id_utilisateur) VALUES
        ('0612345678', 1500.00, TRUE, 1),
        ('0698765432', 2300.50, TRUE, 2),
        ('0711223344', 500.00, TRUE, 3)");

    $pdo->query("INSERT INTO compte (numero_tel, solde, is_default, id_utilisateur) VALUES
        ('0622334455', 200.00, FALSE, 1),
        ('0644556677', 0.00, FALSE, 1),
        ('0688990011', 750.25, FALSE, 2),
        ('0633445566', 100.00, FALSE, 3)");

    $pdo->query("INSERT INTO transaction (date_transaction, montant, type_transaction, id_compte_source, beneficiaire, reference_paiement) VALUES
        ('2023-01-15 12:00:00', 45.90, 'PAIEMENT', 1, 'EDF', 'FACT-EDF-001'),
        ('2023-01-16 08:30:00', 29.99, 'PAIEMENT', 2, 'SFR', 'FACT-SFR-002'),
        ('2023-01-17 17:45:00', 15.50, 'PAIEMENT', 3, 'Carrefour', 'CB-20230117'),
        ('2023-01-18 13:20:00', 120.00, 'PAIEMENT', 1, 'Free Mobile', 'FACT-FREE-003'),
        ('2023-01-19 09:10:00', 60.00, 'PAIEMENT', 2, 'Amazon', 'CMD-AMZ-456')");

    $pdo->commit();
} catch (\PDOException $pdoE) {
    $pdo->rollBack();
    throw new PDOException("Une erreur s'est produit => " . $pdoE->getMessage());
}
