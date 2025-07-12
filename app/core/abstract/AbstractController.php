<?php

namespace APP\CORE\ABSTRACT;

use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use APP\CORE\Session;
use MAXITSA\ENTITY\TypeUser;

abstract class AbstractController extends Singleton
{
    protected ?Session $session = null;
    protected string $commonlayout = "security.layout.php";
    protected array $prefixes = [
        TypeUser::CLIENT->value => 'client',
        TypeUser::SERVICE_COMMERCIAL->value => 'service_commercial',
    ];

    public function __construct()
    {
        $this->session = App::getDependencie(DependanceKey::CORE, ClassKey::SESSION);
    }

    protected function headerLoc(string $loc): void
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");

        $this->session->start();

        if ($this->session->has('user')) {
            $user = $this->session->get('user');
            if (isset($user['type'])) {
                $loc = $this->prefixFromUserType($loc, $user['type']);
            }
        }

        header("Location: " . $loc);
        exit;
    }

    protected function prefixFromUserType(string $loc, string $userType): string
    {

        if (isset($this->prefixes[$userType])) {
            return '/' . trim($this->prefixes[$userType] . '/' . ltrim($loc, '/'), '/');
        }

        return $loc;
    }

    abstract public function index();
    abstract public function show();
    abstract public function create();
    abstract public function edit();
    abstract public function destroy();

    protected function renderHtml(string $view, array $data = [])
    {
        extract($data);
        ob_start();
        require_once '../templates/' . $view;
        $content = ob_get_clean();
        require_once '../templates/layouts/' . $this->commonlayout;
    }
}
