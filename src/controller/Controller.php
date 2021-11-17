<?php

namespace Alex\Src\Controller;

use Alex\Config\Request;
use Alex\Src\Constraint\Validation;
use Alex\Src\DAO\ArticleDAO;
use Alex\Src\DAO\CommentDAO;
use Alex\Src\DAO\UserDAO;
use Exception;

abstract class Controller
{
    protected $articleDAO;
    protected $commentDAO;
    protected $userDAO;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;
    private $file;
    private $title;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->validation = new Validation();
        $request = new Request();
        $this->get = $request->getGet();
        $this->post = $request->getPost();
        $this->session = $request->getSession();
    }

    public function checkToken($token)
    {
        if (!$this->session->get('token') || $this->session->get('token') != $token) {
            $this->session->set('need_token', 'Le token a expiré');

            throw new Exception('Le token a expiré');
        }

        return true;
    }

    public function checkLoggedIn()
    {
        if (!$this->session->get('pseudo')) {
            throw new Exception("L'utilisateur n'est pas connecté");
        }

        return true;
    }

    public function checkAdmin()
    {
        $this->checkLoggedIn();
        if (!('admin' === $this->session->get('role'))) {
            throw new Exception("L'utilisateur ne dispose pas des droits nécessaires pour accéder à cette page");
        }

        return true;
    }

    public function render($template, $data = [])
    {
        $this->file = '../templates/'.$template.'.php';
        $content = $this->renderFile($this->file, $data);
        $view = $this->renderFile(
            '../templates/base.php',
            [
                'title' => $this->title,
                'content' => $content,
                'session' => $this->session,
            ]
        );
        echo $view;
    }

    public function renderAdmin($template, $data = [])
    {
        $this->file = '../templates/'.$template.'.php';
        $content = $this->renderFile($this->file, $data);
        $view = $this->renderFile(
            '../templates/baseAdmin.php',
            [
                'title' => $this->title,
                'content' => $content,
                'session' => $this->session,
            ]
        );
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();

            include $file;

            return ob_get_clean();
        }
        header('Location: index.php?route=notFound');
    }
}
