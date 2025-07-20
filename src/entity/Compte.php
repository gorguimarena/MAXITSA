<?php

namespace MAXITSA\ENTITY;

use APP\CORE\ABSTRACT\AbstractEntity;

class Compte extends AbstractEntity
{
    private int $id;
    private float $solde;
    private string $numero_tel;
    private bool $is_default = false;
    private Client $client;
    private array $transactions = [];

    public function __construct()
    {
        $this->client = new Client();
    }

    public static function toObject(array $data): static
    {
        $compte = new static();
        $compte->setId($data['id'] ?? 0);
        $compte->setSolde((float) $data['solde'] ?? 0.0);
        $compte->setNumeroTel($data['numero_tel'] ?? '');
        $compte->setIsDefault((bool) $data['is_default'] ?? false);


        if (isset($data['client']) && is_array($data['client'])) {
            $compte->setClient(Client::toObject($data['client']));
        } elseif (isset($data['id_utilisateur'])) {
            $client = new Client();
            $client->setId((int) $data['id_utilisateur']);
            $compte->setClient($client);
        }


        if (isset($data['transactions']) && is_array($data['transactions'])) {
            $transactions = [];
            foreach ($data['transactions'] as $transactionData) {
                if (isset($transactionData['type_transaction'])) {
                    $type = $transactionData['type_transaction'];
                    $transaction = match ($type) {
                        TypeTransaction::TRANSFERT->value => Transfert::toObject($transactionData),
                        TypeTransaction::PAIEMENT->value => Paiement::toObject($transactionData),
                        default => null
                    };

                    if ($transaction !== null) {
                        $transactions[] = $transaction;
                    }
                }
            }
            $compte->setTransactions($transactions);
        }

        return $compte;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'solde' => $this->solde,
            'numero_tel' => $this->numero_tel,
            'is_default' => $this->is_default,
            'client_id' => $this->client->getId(),
            'transactions' => array_map(fn($t) => $t->toArray(), $this->transactions)
        ];
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSolde(): float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): void
    {
        $this->solde = $solde;
    }

    public function getNumeroTel(): string
    {
        return $this->numero_tel;
    }

    public function setNumeroTel(string $numero_tel): void
    {
        $this->numero_tel = $numero_tel;
    }

    public function isDefault(): bool
    {
        return $this->is_default ?? false;
    }

    public function setIsDefault(bool $is_default): void
    {
        $this->is_default = $is_default;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function setTransactions(array $transactions): void
    {
        $this->transactions = $transactions;
    }

    public function addTransactions(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }
}
