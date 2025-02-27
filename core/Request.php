<?php

namespace app\core;

class Request {

    public Session $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() {
        return $this->getMethod() === 'get';
    }

    public function isPost() {
        return $this->getMethod() === 'post';
    }

    public function getBody() {
        $body = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        else if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}