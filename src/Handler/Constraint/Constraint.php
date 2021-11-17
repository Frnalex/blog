<?php

namespace Alex\Src\Handler\Constraint;

class Constraint
{
    public function notBlank($name, $value)
    {
        if (empty($value)) {
            return 'Le champ ' . $name . ' est vide';
        }
        return null;
    }

    public function minLength($name, $value, $minSize)
    {
        if (strlen($value) < $minSize) {
            return 'Le champ ' . $name . ' doit contenir au moins ' . $minSize . ' caractères';
        }
        return null;
    }

    public function maxLength($name, $value, $maxSize)
    {
        if (strlen($value) > $maxSize) {
            return 'Le champ ' . $name . ' doit contenir au maximum ' . $maxSize . ' caractères';
        }
        return null;
    }

    public function emailValid($value)
    {
        if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $value)) {
            return "L'adresse email n'est pas valide";
        }
        return null;
    }
}