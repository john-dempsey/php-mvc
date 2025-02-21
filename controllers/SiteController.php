<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller {

    public function home() {
        $params = [
            'name' => 'John'
        ];
        return $this->render('home', $params);
    }
}