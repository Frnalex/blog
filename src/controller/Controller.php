<?php

namespace App\src\controller;

use App\config\Request;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

abstract class Controller
{
    protected $articleDAO;
    protected $commentDAO;
    protected $view;
    protected $get;
    protected $post;
    protected $session;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
        $request = new Request();
        $this->get = $request->getGet();
        $this->post = $request->getPost();
        $this->session = $request->getSession();
    }
}