<?php

namespace Alex\Src\DAO;

use Alex\Config\Parameter;
use Alex\Src\Model\Article;

class ArticleDAO extends DAO
{
    public function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['pseudo']);
        $article->setCreatedAt($row['createdAt']);

        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id ORDER BY article.createdAt';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row) {
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();

        return $articles;
    }

    public function getArticle($articleId)
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id WHERE article.id = ?';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();

        return $this->buildObject($article);
    }

    public function addArticle(Parameter $post, $userId)
    {
        $sql = 'INSERT INTO article (title, content, createdAt, user_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery(
            $sql,
            [
                $post->get('title'),
                $post->get('content'),
                $userId,
            ]
        );
    }

    public function editArticle(Parameter $post, $articleId, $userId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, user_id=:userId WHERE id=:articleId';
        $this->createQuery(
            $sql,
            [
                'title' => $post->get('title'),
                'content' => $post->get('content'),
                'userId' => $userId,
                'articleId' => $articleId,
            ]
        );
    }

    public function deleteArticle($articleId)
    {
        $sql = 'DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$articleId]);
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleId]);
    }
}
