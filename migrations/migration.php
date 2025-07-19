<?php
require_once 'vendor/autoload.php';
require_once 'helpers.php';
require_once 'queriesCreate.php';

$driver = chooseDriver();

$vars = [
    ['DB_NAME', 'maxitsa', 'Nom de la base de données'],
    ['DB_USER', 'gorgui0', 'Nom d’utilisateur de la base de données'],
    ['DB_PASSWORD', 'gorgui0', 'Mot de passe de la base de données'],
    ['DB_HOST', 'db', 'Hôte du serveur de base de données (ex: db, localhost)'],
    ['DB_PORT', $driver === 'pgsql' ? '5432' : '3306', 'Port utilisé par la base de données'],
    ['SITE_PORT', '8000', 'Port sur lequel votre site sera accessible'],
];

$data = [ValueEnv::make('DRIVE', $driver)];

foreach ($vars as [$key, $default, $message]) {
    $value = ask($message, $default);
    $data[] = ValueEnv::make($key, $value);
}

$res = query($queries[$driver], doValueEnvAssoc($data));

if ($res) {
    updateEnvFile($data);
}
