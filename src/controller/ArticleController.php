<?php

namespace Alex\Src\Controller;

use Alex\Config\Parameter;
use Alex\Src\Handler\ArticleHandler;

class ArticleController extends Controller
{
    private $articleHandler;

    public function __construct()
    {
        parent::__construct();
        $this->articleHandler = new ArticleHandler();
    }

    public function showArticle($articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);

        return $this->render(
            'single',
            [
                'article' => $article,
                'comments' => $comments,
            ]
        );
    }

    public function addArticle(Parameter $post)
    {
        $this->checkAdmin();
        $errors = [];
        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $errors = $this->articleHandler->add($post);
        }

        return $this->renderAdmin(
            'add_article',
            [
                'post' => $post,
                'errors' => $errors,
            ]
        );
    }

    public function editArticle(Parameter $post, $articleId)
    {
        $this->checkAdmin();
        $article = $this->articleDAO->getArticle($articleId);

        $errors = [];
        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $errors = $this->articleHandler->edit($post, $articleId);
        }

        $post->set('id', $article->getId());
        $post->set('title', $article->getTitle());
        $post->set('content', $article->getContent());
        $post->set('author', $article->getAuthor());

        return $this->renderAdmin(
            'edit_article',
            [
                'post' => $post,
                'errors' => $errors,
            ]
        );
    }

    public function deleteArticle($articleId, $token)
    {
        $this->checkAdmin();
        $this->checkToken($token);
        $this->articleHandler->delete($articleId);
    }
}
