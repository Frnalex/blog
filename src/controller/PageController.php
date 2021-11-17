<?php

namespace Alex\Src\Controller;

use Alex\Config\Parameter;
use Alex\Src\Handler\ContactHandler;

class PageController extends Controller
{
    private $contactHandler;

    public function __construct()
    {
        parent::__construct();
        $this->contactHandler = new ContactHandler();
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
            $this->checkToken($post->get('token'));
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
        $this->checkAdmin();
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
