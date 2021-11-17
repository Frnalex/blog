<?php

namespace Alex\Src\Controller;

use Alex\Config\Request;
use Alex\Src\Service\Security;

abstract class Controller
{
    protected $get;
    protected $post;
    protected $session;
    protected $file;
    protected $title;
    protected $security;

    public function __construct()
    {
        $request = new Request();
        $this->get = $request->getGet();
        $this->post = $request->getPost();
        $this->session = $request->getSession();
        $this->security = new Security();
    }

    public function render($template, $data = [])
    {
        $this->file = '../templates/'.$template.'.php';
        $content = $this->renderFile($this->file, $data);
        $view = $this->renderFile(
            '../templates/base.php',
            [
                'title' => $this->title,
                'content' => $content,
                'session' => $this->session,
            ]
        );
        echo $view;
    }

    public function renderAdmin($template, $data = [])
    {
        $this->file = '../templates/'.$template.'.php';
        $content = $this->renderFile($this->file, $data);
        $view = $this->renderFile(
            '../templates/baseAdmin.php',
            [
                'title' => $this->title,
                'content' => $content,
                'session' => $this->session,
            ]
        );
        echo $view;
    }

    private function renderFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();

            include $file;

            return ob_get_clean();
        }
        header('Location: index.php?route=notFound');
    }
}
