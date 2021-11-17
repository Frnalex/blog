<?php

namespace Alex\Src\Controller;

class ErrorController extends Controller
{
    public function errorNotFound()
    {
        return $this->render('error_404');
    }

    public function errorServer()
    {
        return $this->render('error_500');
    }
}
