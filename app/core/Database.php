<?php

namespace APP\CORE;

use APP\CORE\ABSTRACT\Singleton;
use PDO;

class Database extends Singleton {
    private ?PDO $pdo = null;
    private static array $configDefault = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,          
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

    public function __construct()
    {
        try {
            $dsn = Env::get('DRIVE').':host='.Env::get('DB_HOST').';port='.Env::get('DB_PORT').';dbname=' . Env::get('DB_NAME');
            $this->pdo = new PDO(
                $dsn,
                Env::get('DB_USER'),
                Env::get('DB_PASSWORD'),
                self::$configDefault
            );
        } catch (\PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
    
}

