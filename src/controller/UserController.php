<?php

namespace Alex\Src\Controller;

use Alex\Src\DAO\UserDAO;

class UserController extends Controller
{
    private $userDAO;

    public function __construct()
    {
        parent::__construct();
        $this->userDAO = new UserDAO();
    }

    public function profile()
    {
        $this->security->checkLoggedIn();

        return $this->render('profile');
    }

    public function deleteUser($userId, $token)
    {
        $this->security->checkAdmin();
        $this->security->checkToken($token);

        $this->userDAO->deleteUser($userId);
        $this->session->set('delete_user', "L'utilisateur a bien été supprimé");
        header('Location: /index.php?route=administration');
    }

    public function deleteAccount($token)
    {
        $this->security->checkLoggedIn();
        $this->security->checkToken($token);

        $this->userDAO->deleteAccount($this->session->get('id'));
        $this->session->stop();
        $this->session->start();
        $this->session->set('delete_account', 'Votre compte a bien été supprimé');
        header('Location: /index.php');
    }
}
