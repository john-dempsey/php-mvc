<?php

use app\core\Application;
use app\core\Session;

function flash() {
    $session = Application::$app->request->session;
    $flash = $session->get(Session::FLASH);
    $session->remove(Session::FLASH);
    return $flash;
}

function old($key, $default=null) {
    $session = Application::$app->request->session;
    $result = $default;
    $data = $session->get(Session::FORM_DATA);
    if ($data && is_array($data) && array_key_exists($key, $data)) {
        $result = $data[$key];
    }
    return $result;
}
  
function error($key) {
    $session = Application::$app->request->session;
    $result = null;
    $errors = $session->get(Session::FORM_ERRORS);
    if ($errors && is_array($errors) && array_key_exists($key, $errors)) {
        $result = $errors[$key];
    }
    return $result;
}

function chosen($key, $search, $default=null) {
    $session = Application::$app->request->session;
    $result = FALSE;
    $data = $session->get(Session::FORM_DATA);
    if ($data && is_array($data) && array_key_exists($key, $data)) {
        $value = $data[$key];
        if (is_array($value)) {
            $result = in_array($search, $value);
        }
        else {
            $result = strcmp($value, $search) === 0;
        }
    }
    else if ($default !== null) {
        if (is_array($default)) {
            $result = in_array($search, $default);
        }
        else {
            $result = strcmp($default, $search) === 0;
        }
    }
    return $result;
}

function clear_form_data() {
    $session = Application::$app->request->session;
    $session->remove(Session::FORM_DATA);
    $session->remove(Session::FORM_ERRORS);
}