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

    public function index() {
        $id = $this->session->get('user')['id'];
        $comptes =  $this->compte_service->get_comptes($id);

        $this->renderHtml('compte/liste.php', ['comptes' => $comptes]);
    }
    public function show() {}

    public function create()
    {
        $this->renderHtml('compte/new_compte.php');
    }
    public function edit() {}

    public function update_compte(int $id) : void {
        $id_user = $this->session->get('user')['id'];

        $res = $this->compte_service->compte_to_principale($id,$id_user);

        $this->headerLoc('comptes');
    }
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
