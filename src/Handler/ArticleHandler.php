<?php

namespace Alex\Src\Handler;

use Alex\Src\DAO\ArticleDAO;

class ArticleHandler extends Handler
{
    private $articleDAO;

    public function __construct()
    {
        parent::__construct();
        $this->articleDAO = new ArticleDAO();
    }

    public function add($post)
    {
        $this->security->checkToken($post->get('token'));
        $errors = $this->validation->validate($post, 'Article');

        if ($errors) {
            return $errors;
        }

        $this->articleDAO->addArticle($post, $this->session->get('id'));
        $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
        header('Location: /index.php?route=administration');
    }

    public function edit($post, $articleId)
    {
        $this->security->checkToken($post->get('token'));
        $errors = $this->validation->validate($post, 'Article');

        if ($errors) {
            return $errors;
        }

        $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
        $this->session->set('edit_article', 'L\'article a bien été modifié');
        header('Location: /index.php?route=administration');
    }

    public function delete($articleId, $token)
    {
        $this->security->checkToken($token);
        $this->articleDAO->deleteArticle($articleId);
        $this->session->set('delete_article', "L'article a bien été supprimé");
        header('Location: /index.php?route=administration');
    }
}
