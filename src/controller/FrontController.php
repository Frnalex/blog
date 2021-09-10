<?php

namespace App\Src\Controller;

use App\Config\Parameter;

class FrontController extends Controller
{
    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render(
            'home',
            [
                'articles' => $articles
            ]
        );
    }

    public function article($articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        return $this->view->render(
            'single',
            [
                'article' => $article,
                'comments' => $comments,
            ]
        );
    }

    public function flagComment($commentId, $token)
    {
        if ($this->checkToken($token)) {
            $this->commentDAO->flagComment($commentId);
            $this->session->set('flag_comment', 'Le commentaire a bien été signalé');
            header('Location: /index.php');
        }
    }

    public function register(Parameter $post)
    {
        $errors = [];
        if ($post->get('submit')) {
            $this->checkToken($post->get('token'));
            $errors = $this->validation->validate($post, 'User');

            //Check si le pseudo existe déjà
            if ($this->userDAO->checkUser($post)) {
                $errors['pseudo'] = $this->userDAO->checkUser($post);
            }

            if (!$errors) {
                $this->userDAO->register($post);
                $this->session->set('register', 'Votre inscription a bien été effectuée');
                header('Location: /index.php');
            }
        }
        return $this->view->render(
            'register',
            [
                'post' => $post,
                'errors' => $errors,
            ]
        );
    }

    public function login(Parameter $post)
    {
        if ($post->get('submit')) {
            $this->checkToken($post->get('token'));
            $result = $this->userDAO->login($post);

            if ($result && $result['isPasswordValid']) {
                $this->session->set('login', 'Content de vous revoir');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['name']);
                $this->session->set('pseudo', $post->get('pseudo'));
                header('Location: /index.php');
            } else {
                $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
            }
        }
        return $this->view->render(
            'login',
            [
                'post' => $post
            ]
        );
    }

    public function contact(Parameter $post)
    {
        $errors = [];
        if ($post->get('submit')) {
            $this->checkToken($post->get('token'));
            $errors = $this->validation->validate($post, 'Contact');

            if (!$errors) {
                $this->sendMail($post->get('name'), $post->get('email'), $post->get('message'));
            }
        }
        return $this->view->render(
            'contact',
            [
                'post' => $post,
                'errors' => $errors,
            ]
        );
    }
}
