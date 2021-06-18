<?php

namespace App\src\model;

class Comment
{
    private $id;
    private $pseudo;
    private $content;
    private $createdAt;


    //Getters
    public function getId()
    {
        return $this->id;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    //Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}