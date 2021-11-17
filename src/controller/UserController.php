<?php

namespace Alex\Src\Controller;

class UserController extends Controller
{
    public function profile()
    {
        $this->checkLoggedIn();

        return $this->render('profile');
    }

    public function deleteUser($userId, $token)
    {
        $this->checkAdmin();
        $this->checkToken($token);

        $this->userDAO->deleteUser($userId);
        $this->session->set('delete_user', "L'utilisateur a bien été supprimé");
        header('Location: /index.php?route=administration');
    }

    public function deleteAccount($token)
    {
        $this->checkLoggedIn();
        $this->checkToken($token);

        $this->userDAO->deleteAccount($this->session->get('id'));
        $this->session->stop();
        $this->session->start();
        $this->session->set('delete_account', 'Votre compte a bien été supprimé');
        header('Location: /index.php');
    }
}
