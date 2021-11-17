<?php

namespace Alex\Src\Handler;

use Alex\Config\Request;
use Alex\Src\Constraint\Validation;

abstract class Handler
{
    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->validation = new Validation();
        $request = new Request();
        $this->session = $request->getSession();
    }
}
