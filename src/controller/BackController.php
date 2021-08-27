<?php

namespace App\src\controller;

use App\config\Parameter;
use Exception;

class BackController extends Controller
{
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
        if (!($this->session->get('role') === 'admin')) {
            throw new Exception("L'utilisateur ne dispose pas des droits nécessaires pour accéder à cette page");
        }
        return true;
    }

    public function administration()
    {
        $this->checkAdmin();
        $articles = $this->articleDAO->getArticles();
        $comments = $this->commentDAO->getFlagComments();
        $users = $this->userDAO->getUsers();

        return $this->view->renderAdmin(
            'administration',
            [
                'articles' => $articles,
                'comments' => $comments,
                'users' => $users,
            ]
        );
    }

    public function addArticle(Parameter $post)
    {
        $this->checkAdmin();
        $errors = [];
        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors) {
                $this->articleDAO->addArticle($post, $this->session->get('id'));
                $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                header('Location: /index.php?route=administration');
            }
        }
        return $this->view->renderAdmin(
            'add_article',
            [
                'post' => $post,
                'errors' => $errors
            ]
        );
    }

    public function editArticle(Parameter $post, $articleId)
    {
        $this->checkAdmin();
        $errors = [];

        $article = $this->articleDAO->getArticle($articleId);
        if ($post->get('submit')) {
            $this->checkToken($post->get('token'));
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors) {
                $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
                $this->session->set('edit_article', 'L\'article a bien été modifié');
                header('Location: /index.php?route=administration');
            }
        }

        $post->set('id', $article->getId());
        $post->set('title', $article->getTitle());
        $post->set('content', $article->getContent());
        $post->set('author', $article->getAuthor());

        return $this->view->renderAdmin(
            'edit_article',
            [
                'post' => $post,
                'errors' => $errors
            ]
        );
    }

    public function deleteArticle($articleId, $token)
    {
        $this->checkAdmin();
        $this->checkToken($token);

        $this->articleDAO->deleteArticle($articleId);
        $this->session->set('delete_article', "L'article a bien été supprimé");
        header('Location: /index.php?route=administration');
    }

    public function addComment(Parameter $post, $articleId)
    {
        $this->checkLoggedIn();

        if ($post->get('submit')) {
            $this->checkToken($post->get('token'));
            $errors = $this->validation->validate($post, "Comment");

            if (!$errors) {
                $this->commentDAO->addComment($post, $articleId, $this->session->get('id'));
                $this->session->set('add_comment', "Le nouveau commentaire a bien été ajouté");
                header('Location: /index.php?route=article&articleId=' . $articleId);
            }

            $article = $this->articleDAO->getArticle($articleId);
            $comments = $this->commentDAO->getCommentsFromArticle($articleId);
            return $this->view->render(
                'single',
                [
                    'article' => $article,
                    'comments' => $comments,
                    'post' => $post,
                    'errors' => $errors,
                ]
            );
        }
    }

    public function unflagComment($commentId, $token)
    {
        $this->checkAdmin();
        $this->checkToken($token);

        $this->commentDAO->unflagComment($commentId);
        $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');
        header('Location: /index.php?route=administration');
    }

    public function deleteComment($commentId, $token)
    {
        $this->checkAdmin();
        $this->checkToken($token);

        $this->commentDAO->deleteComment($commentId);
        $this->session->set('delete_comment', "Le commentaire a bien été supprimé");
        header('Location: /index.php?route=administration');
    }

    public function profile()
    {
        $this->checkLoggedIn();
        return $this->view->render('profile');
    }

    public function updatePassword(Parameter $post)
    {
        $this->checkLoggedIn();

        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
            $this->session->set('update_password', 'Le mot de passe a bien été modifié');
            header('Location: /index.php?route=profile');
        }
        return $this->view->render('update_password');
    }

    public function logout()
    {
        $this->checkLoggedIn();

        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'Vous avez bien été déconnecté');
        header('Location: /index.php');
    }

    public function deleteAccount($token)
    {
        $this->checkLoggedIn();
        $this->checkToken($token);

        $this->userDAO->deleteAccount($this->session->get('id'));
        $this->session->stop();
        $this->session->start();
        $this->session->set('delete_account', 'Votre compte a bien été supprimé');
        header('Location: /index.php');
    }

    public function deleteUser($userId, $token)
    {
        $this->checkAdmin();
        $this->checkToken($token);

        $this->userDAO->deleteUser($userId);
        $this->session->set('delete_user', "L'utilisateur a bien été supprimé");
        header('Location: /index.php?route=administration');
    }
}