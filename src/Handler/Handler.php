<?php

namespace Alex\Src\Handler;

use Alex\Config\Request;
use Alex\Src\Handler\Constraint\Validation;
use Alex\Src\Service\Security;

abstract class Handler
{
    protected $validation;
    protected $session;
    protected $security;

    public function __construct()
    {
        $this->validation = new Validation();
        $request = new Request();
        $this->session = $request->getSession();
        $this->security = new Security();
    }
}
