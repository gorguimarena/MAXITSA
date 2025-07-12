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
            exit;
        }

        $compte = $this->compte_service->getDefaultCompteByUtilisateur($user['id']);
        $data = [
            'limit' => 10,
            'offset' => 0,
        ];

        $transactions = $this->transactionService->getTransactionsByCompte($compte->getId(), $data);

        $data = [
            'compte' => $compte,
            'transactions' => $transactions
        ];

        $this->renderHtml('client/dashbord.php', $data);
    }

    public function show() {}
    public function create() {}
    public function edit() {}
    public function destroy() {}
}
