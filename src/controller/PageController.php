<?php

namespace Alex\Src\Controller;

use Alex\Config\Parameter;
use Alex\Src\DAO\ArticleDAO;
use Alex\Src\DAO\CommentDAO;
use Alex\Src\DAO\UserDAO;
use Alex\Src\Handler\ContactHandler;

class PageController extends Controller
{
    private $contactHandler;
    private $articleDAO;
    private $commentDAO;
    private $userDAO;

    public function __construct()
    {
        parent::__construct();
        $this->contactHandler = new ContactHandler();
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
    }

    public function home()
    {
        $articles = $this->articleDAO->getArticles();

        return $this->render(
            'home',
            [
                'articles' => $articles,
            ]
        );
    }

    public function contact(Parameter $post)
    {
        $errors = [];
        if ($post->get('submit')) {
            $errors = $this->contactHandler->contact($post);
        }

        return $this->render(
            'contact',
            [
                'post' => $post,
                'errors' => $errors,
            ]
        );
    }

    public function administration()
    {
        $this->security->checkAdmin();
        $articles = $this->articleDAO->getArticles();
        $comments = $this->commentDAO->getFlagComments();
        $users = $this->userDAO->getUsers();

        return $this->renderAdmin(
            'administration',
            [
                'articles' => $articles,
                'comments' => $comments,
                'users' => $users,
            ]
        );
    }
}
