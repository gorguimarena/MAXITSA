<?php

namespace MAXITSA\CONTOLLER;

use APP\CORE\ABSTRACT\AbstractController;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use MAXITSA\SERVICE\CompteService;
use MAXITSA\SERVICE\TransactionService;


class TransactionController extends AbstractController
{
    private TransactionService $transactionService;
    private CompteService $compte_service;

    public function __construct()
    {
        parent::__construct();
        $this->commonlayout = 'base.layout.php';
        $this->transactionService = App::getDependencie(DependanceKey::SERVICE, ClassKey::TRANSACTION_SERVICE);
        $this->compte_service = App::getDependencie(DependanceKey::SERVICE, ClassKey::COMPTE_SERVICE);
    }

    public function index(): void
{
    $user = $this->session->get('user');
    if (!$user) {
        $this->headerLoc('/');
        return;
    }

    $compte = $this->compte_service->getDefaultCompteByUtilisateur($user['id']);

    $data = [
        'limit' => $_GET['limit'] ?? 10,
        'offset' => $_GET['offset'] ?? 0,
        'type' => $_GET['type'] ?? null,
        'date' => $_GET['date'] ?? null
    ];

    $transactions = $this->transactionService->getTransactionsByCompte($compte->getId(), $data);

    $this->renderHtml('transaction/liste.php', [
        'compte' => $compte,
        'transactions' => $transactions,
        'filters' => $data,
        'search' => $_GET['search'] ?? false,
    ]);
}


    public function show() {}
    public function create() {}
    public function edit() {}
    public function destroy() {}
}
