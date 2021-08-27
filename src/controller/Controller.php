<?php

namespace App\src\controller;

use App\config\Request;
use App\src\constraint\Validation;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\controller\View;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

abstract class Controller
{
    protected $articleDAO;
    protected $commentDAO;
    protected $userDAO;
    protected $view;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->view = new View();
        $this->validation = new Validation();
        $request = new Request();
        $this->get = $request->getGet();
        $this->post = $request->getPost();
        $this->session = $request->getSession();
    }

    public function checkToken($token)
    {
        if (!$this->session->get('token') || $this->session->get('token') != $token) {
            $this->session->set('need_token', 'Le token a expiré');
            throw new Exception("Le token a expiré");
        }
        return true;
    }

    public function sendMail($name, $email, $message)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport($_ENV["SMTP_HOST"], $_ENV["SMTP_PORT"]))
            ->setUsername($_ENV["SMTP_USERNAME"])
            ->setPassword($_ENV["SMTP_PASSWORD"]);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Nouveau message reçu depuis le blog'))
            ->setFrom([$email => $name])
            ->setTo(['alexandre.fournou@gmail.com' => 'Alexandre Fournou'])
            ->setBody($message);

        // Send the message
        $result = $mailer->send($message);

        if ($result) {
            $this->session->set('email_send', 'Votre email a bien été envoyé');
        } else {
            $this->session->set('email_error', "Une erreur est survenue, votre mail n'a pas été envoyé");
        }
    }
}