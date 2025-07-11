<?php
namespace MAXITSA\REPOSITORY;

use APP\CORE\ABSTRACT\AbstractRepository;
use APP\CORE\ABSTRACT\Singleton;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use PDO;

class SecurityRepository extends AbstractRepository{
    private ?PDO $pdo;

    public function __construct()
    {
        $this->pdo = App::getDependencie(DependanceKey::DATABASE, ClassKey::DATABASE)->getConnection();
    }
}