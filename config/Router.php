<?php

namespace App\config;

use App\src\controller\BackController;
use App\src\controller\FrontController;
use App\src\controller\ErrorController;
use Exception;

class Router
{
    private $backController;
    private $frontController;
    private $errorController;

    public function __construct()
    {
        $this->backController = new BackController;
        $this->frontController = new FrontController;
        $this->errorController = new ErrorController;
    }

    public function run()
    {
        try {
            if (isset($_GET['route'])) {
                if ($_GET['route'] === 'article') {
                    $this->frontController->article($_GET['articleId']);
                } elseif ($_GET['route'] === 'addArticle') {
                    $this->backController->addArticle($_POST);
                } else {
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}