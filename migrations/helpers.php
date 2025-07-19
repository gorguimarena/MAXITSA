<?php


function updateEnvFile(array $data, $env = './.env'): void
{
    if (!file_exists($env) && !touch($env)) {
        throw new Exception("Une erreur s'est produite lors de la création  du fichier .env !");
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

    public function key(): string
    {
        return $this->key;
    }

    public function value(): string
    {
        return $this->value;
    }
}

function ask(string $message, string $default): string
{
    echo "$message [$default]: ";
    $input = trim(fgets(STDIN));
    return $input !== '' ? $input : $default;
}

function chooseDriver(): string
{
    do {
        echo "\n=== Choix du SGBD ===\n";
        echo "1. PostgreSQL\n";
        echo "2. MySQL\n";
        echo "Choix du SGBD [1] : ";
        $choice = trim(fgets(STDIN));
    } while (!in_array($choice, ['1', '2', ''], true));

    return match ($choice) {
        '2' => 'mysql',
        default => 'pgsql',
    };
}

function query(array $queries, array $config): bool
{
    $drive = strtolower($config['DRIVE']);
    $dbName = $config['DB_NAME'];

    try {
        $defaultDb = $drive === 'pgsql' ? 'postgres' : null;
        $dsn = "{$config['DRIVE']}:host={$config['DB_HOST']};port={$config['DB_PORT']}";
        if ($defaultDb !== null) {
            $dsn .= ";dbname=$defaultDb";
        }

        $pdo = new PDO($dsn, $config['DB_USER'], $config['DB_PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($drive === 'pgsql') {
            $exists = $pdo->query("SELECT 1 FROM pg_database WHERE datname = '$dbName'")->fetch();
            if (!$exists) {
                $pdo->exec("CREATE DATABASE \"$dbName\"");
                echo "Base $dbName créée.\n";
            } else {
                echo "Base $dbName existe déjà.\n";
            }
        } else if ($drive === 'mysql') {
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            echo "Base $dbName créée ou existante.\n";
        }

        $dsnDb = "{$config['DRIVE']}:host={$config['DB_HOST']};port={$config['DB_PORT']};dbname=$dbName";
        $pdo = new PDO($dsnDb, $config['DB_USER'], $config['DB_PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->beginTransaction();
        foreach ($queries as $sql) {
            $pdo->exec($sql);
        }
        $pdo->commit();

        echo "Tables créées avec succès.\n";
        return true;

    } catch (PDOException $e) {
        if (isset($pdo) && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo "Erreur : " . $e->getMessage() . "\n";
        return false;
    }
}



function doValueEnvAssoc(array $data): array
{
    $config = [];
    foreach ($data as $env) {
        $config[$env->key()] = $env->value();
    }
    return $config;
}
