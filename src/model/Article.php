<?php

namespace App\src\model;

class Article
{
    private $id;
    private $title;
    private $content;
    private $author;
    private $createdAt;


    //Getters
    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getAuthor()
    {
        return $this->author;
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
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}