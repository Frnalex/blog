<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\User;

class UserDAO extends DAO
{

    private function buildObject($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setRole($row['name']);
        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT user.id, user.pseudo, user.createdAt, role.name FROM user INNER JOIN role ON user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row) {
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function register(Parameter $post)
    {
        $sql = 'INSERT INTO user (pseudo, password, createdAt, role_id) VALUES (?,?,NOW(), ?)';
        $this->createQuery($sql, [
            $post->get('pseudo'),
            password_hash($post->get('password'), PASSWORD_BCRYPT),
            2,
        ]);
    }


    public function checkUser(Parameter $post)
    {
        $sql = 'SELECT COUNT(pseudo) FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [
            $post->get('pseudo')
        ]);
        $isUnique = $result->fetchColumn();
        if ($isUnique) {
            return '<p>Le pseudo existe déjà</p>';
        }
    }


    // Requête pour vérifier que le pseudo existe et que le mot de passe correspond
    public function login(Parameter $post)
    {
        $sql = "SELECT user.id, user.role_id, user.password, role.name FROM user INNER JOIN role ON role.id = user.role_id WHERE pseudo = ?";
        $data = $this->createQuery($sql, [$post->get('pseudo')]);
        $result = $data->fetch();

        if ($result) {
            $isPasswordValid = password_verify($post->get('password'), $result["password"]);
            return [
                'result' => $result,
                'isPasswordValid' => $isPasswordValid,
            ];
        } else {
            return null;
        }
    }


    public function updatePassword(Parameter $post, $pseudo)
    {
        $sql = 'UPDATE user SET password = ? WHERE pseudo = ?';
        $this->createQuery($sql, [
            password_hash($post->get('password'), PASSWORD_BCRYPT),
            $pseudo
        ]);
    }


    public function deleteAccount($userId)
    {
        //supprime les commentaires
        $sql = 'DELETE FROM comment WHERE user_id = ?';
        $this->createQuery($sql, [$userId]);

        //supprime le compte
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$userId]);
    }

    public function deleteUser($userId)
    {
        //supprime les commentaires
        $sql = 'DELETE FROM comment WHERE user_id = ?';
        $this->createQuery($sql, [$userId]);

        //supprime le compte
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$userId]);
    }
}