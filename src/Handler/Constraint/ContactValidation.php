<?php

namespace Alex\Src\Handler\Constraint;

use Alex\Config\Parameter;

class ContactValidation extends Validation
{
    private $errors = [];
    private $constraint;

    public function __construct()
    {
        $this->constraint = new Constraint();
    }

    public function check(Parameter $post)
    {
        foreach ($post->all() as $key => $value) {
            $this->checkField($key, $value);
        }

        return $this->errors;
    }

    private function checkField($name, $value)
    {
        if ('name' === $name) {
            $error = $this->checkName($name, $value);
            $this->addError($name, $error);
        } elseif ('email' === $name) {
            $error = $this->checkEmail($name, $value);
            $this->addError($name, $error);
        } elseif ('message' === $name) {
            $error = $this->checkMessage($name, $value);
            $this->addError($name, $error);
        }
    }

    private function addError($name, $error)
    {
        if ($error) {
            $this->errors += [
                $name => $error,
            ];
        }
    }

    private function checkName($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('nom', $value);
        }

        return null;
    }

    private function checkEmail($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('email', $value);
        }
        if ($this->constraint->emailValid($value)) {
            return $this->constraint->emailValid('email', $value);
        }

        return null;
    }

    private function checkMessage($name, $value)
    {
        if ($this->constraint->notBlank($name, $value)) {
            return $this->constraint->notBlank('message', $value);
        }

        return null;
    }
}
