<?php
require_once 'vendor/autoload.php';

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
