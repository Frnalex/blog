<?php

namespace App\Config;

use App\Src\Controller\BackController;
use App\Src\Controller\FrontController;
use App\Src\Controller\ErrorController;
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
                } elseif ($route === 'editArticle') {
                    $this->backController->editArticle($this->request->getPost(), $this->request->getGet()->get('articleId'));
                } elseif ($route === 'deleteArticle') {
                    $this->backController->deleteArticle($this->request->getGet()->get('articleId'), $this->request->getGet()->get('token'));
                } elseif ($route === 'addComment') {
                    $this->backController->addComment($this->request->getPost(), $this->request->getGet()->get('articleId'));
                } elseif ($route === 'flagComment') {
                    $this->frontController->flagComment($this->request->getGet()->get('commentId'), $this->request->getGet()->get('token'));
                } elseif ($route === 'unflagComment') {
                    $this->backController->unflagComment($this->request->getGet()->get('commentId'), $this->request->getGet()->get('token'));
                } elseif ($route === 'deleteComment') {
                    $this->backController->deleteComment($this->request->getGet()->get('commentId'), $this->request->getGet()->get('token'));
                } elseif ($route === 'register') {
                    $this->frontController->register($this->request->getPost());
                } elseif ($route === 'login') {
                    $this->frontController->login($this->request->getPost());
                } elseif ($route === 'profile') {
                    $this->backController->profile();
                } elseif ($route === 'updatePassword') {
                    $this->backController->updatePassword($this->request->getPost());
                } elseif ($route === 'logout') {
                    $this->backController->logout();
                } elseif ($route === 'deleteAccount') {
                    $this->backController->deleteAccount($this->request->getGet()->get('token'));
                } elseif ($route === 'deleteUser') {
                    $this->backController->deleteUser($this->request->getGet()->get('userId'), $this->request->getGet()->get('token'));
                } elseif ($route === 'administration') {
                    $this->backController->administration();
                } elseif ($route === 'contact') {
                    $this->frontController->contact($this->request->getPost());
                } else {
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
?>
            <pre>
    <?php
            print_r($e);
    ?>
</pre>
<?php
        }
    }
}
