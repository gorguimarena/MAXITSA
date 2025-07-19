<?php

namespace MAXITSA\CONTOLLER;

use APP\CORE\ABSTRACT\AbstractController;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use MAXITSA\ENTITY\Compte;
use MAXITSA\SERVICE\CompteService;

class CompteController extends AbstractController
{

    private CompteService $compte_service;

    public function __construct()
    {
        parent::__construct();
        $this->commonlayout = 'base.layout.php';
        $this->compte_service = App::getDependencie(DependanceKey::SERVICE, ClassKey::COMPTE_SERVICE);
    }

    public function index() {}
    public function show() {}
    public function create()
    {
        $this->renderHtml('transaction/new_compte.php');
    }
    public function edit() {}
    public function destroy() {}

    public function store()
    {
        $tel = $_POST['number_tel'] ?? '';
        $solde = $_POST['solde'] ?? '';

        $data = [
            "numero_tel" => $tel,
            "solde" => $solde,
            'id_utilisateur' => $this->session->get('user')['id']
        ];

        $reponse = $this->compte_service->createSecond(Compte::toObject($data));

        $this->headerLoc('trans');
    }
}
