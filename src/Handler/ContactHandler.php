<?php

namespace Alex\Src\Handler;

use Alex\Src\Service\Mailer;

class ContactHandler extends Handler
{
    private $mailer;

    public function __construct()
    {
        parent::__construct();
        $this->mailer = new Mailer();
    }

    public function contact($post)
    {
        $errors = $this->validation->validate($post, 'Contact');

        if ($errors) {
            return $errors;
        }

        $this->mailer->sendMail($post->get('name'), $post->get('email'), $post->get('message'));
    }
}
