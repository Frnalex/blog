<?php

namespace Alex\Src\Controller;

use Alex\Config\Parameter;
use Alex\Src\Handler\AuthenticationHandler;

class AuthenticationController extends Controller
{
    private $authenticationHandler;

    public function __construct()
    {
        parent::__construct();
        $this->authenticationHandler = new AuthenticationHandler();
    }

    public function register(Parameter $post)
    {
        $errors = [];
        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $errors = $this->authenticationHandler->register($post);
        }

        return $this->render(
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
            $this->authenticationHandler->login($post);
        }

        return $this->render(
            'login',
            [
                'post' => $post,
            ]
        );
    }

    public function logout()
    {
        $this->checkLoggedIn();
        $this->authenticationHandler->logout();
    }

    public function updatePassword(Parameter $post)
    {
        $this->checkLoggedIn();

        if ($post->get('submit') && $this->checkToken($post->get('token'))) {
            $this->authenticationHandler->updatePassword($post);
        }

        return $this->render('update_password');
    }
}
