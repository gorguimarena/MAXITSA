<?php

namespace MAXITSA\ENTITY;

use APP\CORE\ABSTRACT\AbstractEntity;


abstract class Utilisateur extends AbstractEntity
{
    protected int $id;
    protected TypeUser $typeUser;
    protected string $password;

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTypeUser(TypeUser $typeUser): void
    {
        $this->typeUser = $typeUser;
    }

    public function getTypeUser(): TypeUser
    {
        return $this->typeUser;
    }
}
