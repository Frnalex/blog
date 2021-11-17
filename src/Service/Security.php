<?php

namespace Alex\Src\Service;

use Alex\Config\Request;
use Exception;

class Security
{
    private $session;

    public function __construct()
    {
        $request = new Request();
        $this->session = $request->getSession();
    }

    public function checkToken($token)
    {
        if (!$this->session->get('token') || $this->session->get('token') != $token) {
            $this->session->set('need_token', 'Le token a expiré');

            throw new Exception('Le token a expiré');
        }

        return true;
    }

    public function checkLoggedIn()
    {
        if (!$this->session->get('pseudo')) {
            throw new Exception("L'utilisateur n'est pas connecté");
        }

        return true;
    }

    public function checkAdmin()
    {
        $this->checkLoggedIn();
        if (!('admin' === $this->session->get('role'))) {
            throw new Exception("L'utilisateur ne dispose pas des droits nécessaires pour accéder à cette page");
        }

        return true;
    }
}
