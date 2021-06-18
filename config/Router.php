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
    private $request;

    public function __construct()
    {
        $this->backController = new BackController;
        $this->frontController = new FrontController;
        $this->errorController = new ErrorController;
        $this->request = new Request();
    }

    public function run()
    {
        try {
            $route = $this->request->getGet()->get('route');
            if (isset($route)) {
                if ($route === 'article') {
                    $this->frontController->article($this->request->getGet()->get('articleId'));
                } elseif ($route === 'addArticle') {
                    $this->backController->addArticle($this->request->getPost());
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