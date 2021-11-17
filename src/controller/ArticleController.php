<?php

namespace Alex\Src\Controller;

use Alex\Config\Parameter;
use Alex\Src\DAO\ArticleDAO;
use Alex\Src\DAO\CommentDAO;
use Alex\Src\Handler\ArticleHandler;

class ArticleController extends Controller
{
    private $articleHandler;
    private $articleDAO;
    private $commentDAO;

    public function __construct()
    {
        parent::__construct();
        $this->articleHandler = new ArticleHandler();
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
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
        $this->security->checkAdmin();
        $errors = [];
        if ($post->get('submit')) {
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
        $this->security->checkAdmin();
        $article = $this->articleDAO->getArticle($articleId);

        $errors = [];
        if ($post->get('submit')) {
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
        $this->security->checkAdmin();
        $this->articleHandler->delete($articleId, $token);
    }
}
