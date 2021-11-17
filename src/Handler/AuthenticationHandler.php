<?php

namespace Alex\Src\Handler;

use Alex\Src\DAO\UserDAO;

class AuthenticationHandler extends Handler
{
    private $userDAO;

    public function __construct()
    {
        parent::__construct();
        $this->userDAO = new UserDAO();
    }

    public function register($post)
    {
        $errors = $this->validation->validate($post, 'User');

        //Check si le pseudo existe déjà
        if ($this->userDAO->checkUser($post)) {
            $errors['pseudo'] = $this->userDAO->checkUser($post);
        }

        if ($errors) {
            return $errors;
        }

        $this->userDAO->register($post);
        $this->session->set('register', 'Votre inscription a bien été effectuée');
        header('Location: /index.php');
    }

    public function login($post)
    {
        $result = $this->userDAO->login($post);

        if ($result && $result['isPasswordValid']) {
            $this->session->set('login', 'Content de vous revoir');
            $this->session->set('id', $result['result']['id']);
            $this->session->set('role', $result['result']['name']);
            $this->session->set('pseudo', $post->get('pseudo'));
            header('Location: /index.php');
        } else {
            $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
        }
    }

    public function logout()
    {
        $this->session->stop();
        $this->session->start();
        $this->session->set('logout', 'Vous avez bien été déconnecté');
        header('Location: /index.php');
    }

    public function updatePassword($post)
    {
        $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
        $this->session->set('update_password', 'Le mot de passe a bien été modifié');
        header('Location: /index.php?route=profile');
    }
}
