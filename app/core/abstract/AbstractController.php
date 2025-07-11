<?php

namespace APP\CORE\ABSTRACT;

use APP\CORE\App;
use APP\CORE\ENUM\ClassKey;
use APP\CORE\ENUM\DependanceKey;
use APP\CORE\Session;

abstract class AbstractController extends Singleton
{
    protected ?Session $session = null;
    protected $commonlayout = "base";

    public function __construct()
    {
        $this->session =  App::getDependencie(DependanceKey::CORE, ClassKey::SESSION);
    }
    protected function headerLoc(string $loc): void
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Location: " . $loc);
        exit;
    }

    abstract public function index();
    abstract public function show();
    abstract public function create();
    abstract public function edit();
    abstract public function destroy();
    public function renderHtml(string $view, array $data = []) {}
}
