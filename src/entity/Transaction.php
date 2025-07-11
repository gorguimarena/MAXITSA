<?php
namespace MAXITSA\ENTITY;

use APP\CORE\ABSTRACT\AbstractEntity;

abstract class Transaction extends AbstractEntity {
    protected int $id;
    protected TypeTransaction $type_transaction;
    protected string $dateDebit;
    protected float $montant;
    protected Compte $compte_source;

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTypeTransaction(): TypeTransaction {
        return $this->type_transaction;
    }

    public function getDateDebit(): string {
        return $this->dateDebit;
    }

    public function getMontant(): float {
        return $this->montant;
    }

    public function getCompteSource(): Compte {
        return $this->compte_source;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setTypeTransaction(TypeTransaction $type): void {
        $this->type_transaction = $type;
    }

    public function setDateDebit(string $date): void {
        $this->dateDebit = $date;
    }

    public function setMontant(float $montant): void {
        $this->montant = $montant;
    }

    public function setCompteSource(Compte $compte): void {
        $this->compte_source = $compte;
    }
}
