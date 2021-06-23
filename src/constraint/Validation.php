<?php

namespace App\src\constraint;

class Validation
{
    public function validate($data, $name)
    {
        if ($name === 'Article') {
            $articleValidation = new ArticleValidation();
            return $articleValidation->check($data);
        }
        return null;
    }
}