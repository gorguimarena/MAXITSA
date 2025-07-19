<?php

namespace MAXITSA\CONTOLLER;

use APP\CORE\ABSTRACT\AbstractController;
use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use APP\CORE\FileLoader;
use APP\CORE\Validator;
use MAXITSA\ENTITY\Client;
use MAXITSA\ENTITY\Compte;
use MAXITSA\ENTITY\TypeUser;
use MAXITSA\SERVICE\CompteService;
use MAXITSA\SERVICE\UtilisateurService;

class SecurityController extends AbstractController
{
    private ?CompteService $compte_service = null;
    private ?UtilisateurService $utilisateur_service = null;
    private Validator $validator;

    public function __construct()
    {
        parent::__construct();
        $this->validator = new Validator();
        $this->compte_service = App::getDependencie(DependanceKey::SERVICE, ClassKey::COMPTE_SERVICE);
        $this->utilisateur_service = App::getDependencie(DependanceKey::SERVICE, ClassKey::UTILISATEUR_SERVICE);
    }
    public function show(): void
    {
        $this->renderHtml('security/login.php');
    }

    public function inscript(string $n): void
    {
        $this->session->start();
        switch ($n) {
            case '0':
                $this->renderHtml('security/inscription1.php');
                break;
            case '1':

                $prenom = $_POST['prenom'] ?? '';
                $nom = $_POST['nom'] ?? '';
                $adresse = $_POST['adresse'] ?? '';
                $cni = $_POST['carte_identite'] ?? '';
                $telephone = $_POST['telephone'] ?? '';

                if ($this->compte_service->compteExiste($telephone)) {
                    $this->session->set('errors', ['telephone' => "Un compte avec ce numéro de téléphone existe déjà."]);
                    $this->session->set('old1', $_POST);
                    $this->renderHtml('security/inscription1.php');
                    return;
                }

                if ($this->utilisateur_service->cniExiste($cni)) {
                    $this->session->set('errors', ['carte_identite' => "Un compte avec ce carte d'identite existe déjà."]);
                    $this->session->set('old1', $_POST);
                    $this->renderHtml('security/inscription1.php');
                    return;
                }

                $this->validator->isRequired('prenom', $prenom);
                $this->validator->isRequired('nom', $nom);
                $this->validator->isRequired('adresse', $adresse);
                $this->validator->isRequired('carte_identite', $cni);
                $this->validator->isRequired('telephone', $telephone);
                $this->validator->isPhone('telephone', $telephone);

                if ($this->validator->hasErrors()) {
                    $errors = $this->validator->getErrors();
                    $this->session->set('errors', $errors);
                    $this->session->set('old1', $_POST);
                    $this->renderHtml('security/inscription1.php');
                    return;
                }

                $this->session->set('inscription_step1', $_POST);
                $this->renderHtml('security/inscription2.php');
                break;

            case '2':
                $this->store();
                break;

            default:
                $this->headerLoc('/');
                exit;
        }
    }


    public function store(): void
    {
        $step1 = $this->session->get('inscription_step1') ?? null;
        if (!$step1) {
            $this->headerLoc('/inscription/0');
            return;
        }

        $pwd = $_POST['password'] ?? '';
        $confirmPwd = $_POST['confirm-password'] ?? '';
        $this->validator->isRequired('password', $pwd);
        $this->validator->isSame('password', $pwd, 'confirm-password', $confirmPwd);

        if ($this->validator->hasErrors()) {
            $this->session->set('errors', $this->validator->getErrors());
            $this->session->set('old2', array_merge($_POST, $_FILES));
            return;
        }


        $fileLoader = new FileLoader();
        try {
            $recto = $fileLoader->saveUploadedImage($_FILES['cni_recto']);
            $verso = $fileLoader->saveUploadedImage($_FILES['cni_verso']);
        } catch (\Exception $e) {
            $this->headerLoc('/inscription/1');
            echo "Erreur fichier : " . $e->getMessage();
            return;
        }

        $client = new Client();
        $client->setPrenom($step1['prenom']);
        $client->setNom($step1['nom']);
        $client->setAdresse($step1['adresse']);
        $client->setCni($step1['carte_identite']);
        $client->setCniRecto($recto);
        $client->setCniVerso($verso);
        $client->setPassword(password_hash($pwd, PASSWORD_DEFAULT));
        $client->setTypeUser(TypeUser::CLIENT);

        $compte = new Compte();
        $compte->setNumeroTel($step1['telephone']);
        $compte->setSolde(0.0);
        $compte->setIsDefault(true);
        $compte->setClient($client);
        $compte->setTransactions([]);

        $is_success = $this->compte_service->createCompte($compte);

        $uri = $is_success ? '/?nc=nc' : '/';
        $this->session->destroy();
        $this->headerLoc($uri);
        exit;
    }


    public function index() {}

    public function create(): void
    {
        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';

        $validLogin = $this->validator->isRequired('login', $login);
        $validPassword = $this->validator->isRequired('password', $password);


        $isEmail = false;
        $isPhone = false;
        if ($validLogin) {
            $isEmail = $this->validator->isEmail('login', $login);
            $isPhone = $this->validator->isPhone('login', $login);

            if (!$isEmail && !$isPhone) {
                $this->validator->getErrors()['login'][] = "Le champ login doit être un email ou un numéro valide.";
            }
        }


        if ($this->validator->hasErrors() && !($isEmail || $isPhone)) {
            $this->session->set('errors', $this->validator->getErrors());
            $this->session->set('old', ['login' => $login]);
            $this->renderHtml('security/login.php');
            return;
        }

        $user = $this->utilisateur_service->login($login, $password);


        if (!$user) {
            $this->session->set('errors', ['login' => ['Identifiants invalides.']]);
            $this->session->set('old', ['login' => $login]);
            $this->renderHtml('security/login.php');
            return;
        }

        $this->session->destroy();
        $this->session->set('user', $user->toArray());

        $this->headerLoc('trans');
        exit;
    }



    public function edit() {}

    public function destroy()
    {
        $this->session->destroy();
        $this->headerLoc('/');
    }
}
