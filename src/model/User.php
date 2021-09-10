<?php

namespace App\Src\model;

class User
{
    private $id;
    private $pseudo;
    private $password;
    private $createdAt;
    private $role;


    public function getId()
    {
        return $this->id;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
}
