<?php

namespace App\src\controller;

use App\config\Parameter;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

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
        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $result = $this->userDAO->login($post);

            if ($result && $result['isPasswordValid']) {
                $this->session->set('login', 'Content de vous revoir');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['name']);
                $this->session->set('pseudo', $post->get('pseudo'));
                header('Location: /index.php');
            } else {
                $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
                return $this->view->render(
                    'login',
                    [
                        'post' => $post
                    ]
                );
            }
        }
        return $this->view->render('login');
    }

    public function contact(Parameter $post)
    {
        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $errors = $this->validation->validate($post, 'Contact');

            if (!$errors) {
                $name = $post->get('name');
                $email = $post->get('email');
                $message = $post->get('message');

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
            } else {
                return $this->view->render(
                    'contact',
                    [
                        'post' => $post,
                        'errors' => $errors,
                    ]
                );
            }
        }
        return $this->view->render('contact');
    }
}