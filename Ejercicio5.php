<?php
class Router
{
    private $base_path;
    private $routes;

    function __construct($base_path, $routes)
    {
        $this->$base_path = $base_path;
        $this->$routes = $routes;
    }
    public function route()
    {
        $current_path = str_replace($this->base_path, '/', $_SERVER['REQUEST_URI']);
        $match = false;
        foreach ($this->routes as $regex => $route)
            if (preg_match('#^' . $regex . '$#', $current_path))
                foreach ($route as $method => $todos)
                    if ($_SERVER['REQUEST_METHOD'] == $method) {
                        $match = true;
                        if ($method != 'GET' && $method != 'POST')
                            parse_str(file_get_contents('php://input'), ${'' . $method});
                        foreach ($todos as $todo)
                            print $todo(${'_' . $method} ?? $_GET ?? $_POST);
                    }
        if (!$match) http_response_code(404);
    }
}
