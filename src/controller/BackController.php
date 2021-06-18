<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\model\View;


class BackController
{
    public function addArticle($post)
    {
        if (isset($post['submit'])) {
            $articleDAO = new ArticleDAO();
            $articleDAO->addArticle($post);
            header('Location: ../public/index.php');
        }

        return $this->view->render('add_article', [
            'post' => $post
        ]);
    }
}