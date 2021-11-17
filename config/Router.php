<?php

namespace Alex\Config;

use Alex\Src\Controller\ArticleController;
use Alex\Src\Controller\AuthenticationController;
use Alex\Src\Controller\CommentController;
use Alex\Src\Controller\ErrorController;
use Alex\Src\Controller\PageController;
use Alex\Src\Controller\UserController;
use Exception;

class Router
{
    private $pageController;
    private $authenticationController;
    private $articleController;
    private $commentController;
    private $userController;
    private $errorController;
    private $request;

    public function __construct()
    {
        $this->pageController = new PageController();
        $this->authenticationController = new AuthenticationController();
        $this->articleController = new ArticleController();
        $this->commentController = new CommentController();
        $this->userController = new UserController();
        $this->errorController = new ErrorController();
        $this->request = new Request();
    }

    public function run()
    {
        try {
            $route = $this->request->getGet()->get('route');
            if (isset($route)) {
                if ('article' === $route) {
                    $this->articleController->showArticle($this->request->getGet()->get('articleId'));
                } elseif ('addArticle' === $route) {
                    $this->articleController->addArticle($this->request->getPost());
                } elseif ('editArticle' === $route) {
                    $this->articleController->editArticle($this->request->getPost(), $this->request->getGet()->get('articleId'));
                } elseif ('deleteArticle' === $route) {
                    $this->articleController->deleteArticle($this->request->getGet()->get('articleId'), $this->request->getGet()->get('token'));
                } elseif ('addComment' === $route) {
                    $this->commentController->addComment($this->request->getPost(), $this->request->getGet()->get('articleId'));
                } elseif ('flagComment' === $route) {
                    $this->commentController->flagComment($this->request->getGet()->get('commentId'), $this->request->getGet()->get('token'));
                } elseif ('unflagComment' === $route) {
                    $this->commentController->unflagComment($this->request->getGet()->get('commentId'), $this->request->getGet()->get('token'));
                } elseif ('deleteComment' === $route) {
                    $this->commentController->deleteComment($this->request->getGet()->get('commentId'), $this->request->getGet()->get('token'));
                } elseif ('register' === $route) {
                    $this->authenticationController->register($this->request->getPost());
                } elseif ('login' === $route) {
                    $this->authenticationController->login($this->request->getPost());
                } elseif ('profile' === $route) {
                    $this->userController->profile();
                } elseif ('updatePassword' === $route) {
                    $this->authenticationController->updatePassword($this->request->getPost());
                } elseif ('logout' === $route) {
                    $this->authenticationController->logout();
                } elseif ('deleteAccount' === $route) {
                    $this->userController->deleteAccount($this->request->getGet()->get('token'));
                } elseif ('deleteUser' === $route) {
                    $this->userController->deleteUser($this->request->getGet()->get('userId'), $this->request->getGet()->get('token'));
                } elseif ('administration' === $route) {
                    $this->pageController->administration();
                } elseif ('contact' === $route) {
                    $this->pageController->contact($this->request->getPost());
                } else {
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->pageController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}
