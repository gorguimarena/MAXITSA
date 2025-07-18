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

$cusror = $pdo->query("INSERT INTO utilisateur (nom, prenom, password, type, adresse, cni, cni_recto, cni_verso) VALUES
('Dupont', 'Jean', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CLIENT', '12 Rue de Paris, 75001', '1234567890', 'dupont_recto.jpg', 'dupont_verso.jpg'),
('Martin', 'Sophie', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CLIENT', '34 Avenue des Champs, 75008', '0987654321', 'martin_recto.jpg', 'martin_verso.jpg'),
('Bernard', 'Pierre', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CLIENT', '56 Boulevard Saint-Germain, 75005', '1122334455', 'bernard_recto.jpg', 'bernard_verso.jpg');
");


