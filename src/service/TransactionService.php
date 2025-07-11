<?php

namespace MAXITSA\SERVICE;

use APP\CORE\ABSTRACT\Singleton;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use MAXITSA\REPOSITORY\TransactionRepository;

class TransactionService extends Singleton
{
    private TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = App::getDependencie(DependanceKey::REPOSITORY, ClassKey::TRANSACTION_REPOSITOTY);
    }


    public function getUserTransactions(int $userId): array
    {
        return $this->transactionRepository->getTransactionsByUserDefaultAccount($userId);
    }

    public function getTransactionsByCompte(int $compteId): array
    {
        return $this->transactionRepository->findByCompte($compteId);
    }
}
