<?php
require_once 'vendor/autoload.php';
$tables = [
    "DO $$
BEGIN
   IF NOT EXISTS (
      SELECT FROM pg_database WHERE datname = $db_name
   ) THEN
      CREATE DATABASE $db_name;
   END IF;
END
$$",
    "\c $db_name",
    "CREATE TABLE utilisateur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    type VARCHAR(20) CHECK (type IN ('CLIENT', 'SERVICE_COMMERCIAL')) NOT NULL,
    adresse VARCHAR(255),
    cni VARCHAR(20),
    cni_recto VARCHAR(255),
    cni_verso VARCHAR(255),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)",
    "CREATE TABLE compte (
    id SERIAL PRIMARY KEY,
    numero_tel VARCHAR(20) NOT NULL UNIQUE,
    solde NUMERIC(15, 2) DEFAULT 0.00,
    is_default BOOLEAN DEFAULT FALSE,
    id_utilisateur INT NOT NULL REFERENCES utilisateur(id),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)",
    "CREATE TABLE transaction (
    id SERIAL PRIMARY KEY,
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    montant NUMERIC(15, 2) NOT NULL,
    type_transaction VARCHAR(20) CHECK (type_transaction IN ('PAIEMENT', 'TRANSFERT')) NOT NULL,
    
    id_compte_source INT NOT NULL REFERENCES compte(id),
    id_compte_destination INT REFERENCES compte(id),
    type_transfert VARCHAR(20) CHECK (type_transfert IN ('DEPOT', 'RETRAIT')),
    
    beneficiaire VARCHAR(100),
    reference_paiement VARCHAR(50)
)"
];

class ValueEnv
{
    private string $key;
    private string $value;

    private function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public static function make(string $key, string $value): self
    {
        return new self($key, $value);
    }

    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new Exception("L'attribut $name n'existe pas dans " . static::class);
    }

    function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return;
        }
        throw new Exception("Impossible de définir l'attribut $name dans " . static::class);
    }

    public function __toString(): string
    {
        return "{$this->key}={$this->value}";
    }
}


function updateEnvFile(array $data, $env = './.env'): void
{
    if (!file_exists($env) && !touch($env)) {
        throw new Exception("Une erreur s'est produite lors de la création du fichier .env !");
    }

    $contain = file($env, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

    foreach ($data as $fromData) {
        $found = false;

        foreach ($contain as $index => $line) {
            [$key, $value] = explode("=", $line, 2);
            if ($key === $fromData->key) {
                $contain[$index] = $fromData->__toString();
                $found = true;
                break;
            }
        }

        if (!$found) {
            $contain[] = $fromData->__toString();
        }
    }

    file_put_contents($env, implode(PHP_EOL, $contain) . PHP_EOL);
}


$data = [
    ValueEnv::make('DB_NAME', 'maxitsa'),
    ValueEnv::make('DB_USER', 'gorgui0'),
    ValueEnv::make('DB_HOST', 'db'),
    ValueEnv::make('DB_PASSWORD', 'gorgui0'),
    ValueEnv::make('DRIVE', 'pgsql'),
    ValueEnv::make('SITE_PORT', '8000'),
    ValueEnv::make('DB_PORT', '5432'),
];

updateEnvFile($data);
