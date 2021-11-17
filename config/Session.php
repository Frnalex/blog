<?php

namespace Alex\Config;

class Session
{
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return null;
        }
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function show($name)
    {
        if (isset($_SESSION[$name])) {
            $key = $this->get($name);
            $this->remove($name);
            return $key;
        }
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function start()
    {
        session_start();
    }

    public function stop()
    {
        session_destroy();
    }
}
