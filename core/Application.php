<?php

namespace app\core;

use app\core\db\Database;
use Exception;

class Application {

    public Request $request;
    public Response $response;
    public Router $router;
    public string $layout = 'main';
    public Controller $controller;
    public Database $db;
    public View $view;
    
    public static string $ROOT_DIR;
    public static Application $app;

    public function __construct(string $rootPath, $config) {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->view = new View();
    }

    public function run() {
        try {
            echo $this->router->resolve();
        } 
        catch (Exception $e) {
            echo $this->router->renderView('error', [
                'exception' => $e,
            ]);
        }
    }
}