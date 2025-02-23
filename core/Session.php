<?php

namespace app\core;

use Exception;

class Session {
    public const FLASH = 'flash_messages';
    public const FORM_DATA = 'form_data';
    public const FORM_ERRORS = 'form_errors';

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }
}