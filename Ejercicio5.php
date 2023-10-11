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
// Configuración de Rutas y Métodos HTTP: La clase Router debería tener propiedades para almacenar las rutas y métodos HTTP que se utilizarán para enrutar solicitudes. Estas rutas pueden definirse con patrones y asociarse con controladores o acciones específicas.

// Método route(): El método route() es el punto de entrada principal del enrutador. Cuando se llama a este método, se intenta determinar la ruta actual de la solicitud y se busca una coincidencia en las rutas definidas. Si se encuentra una coincidencia, se verifica si el método HTTP de la solicitud coincide con el método HTTP definido en la ruta.

// Parseo de la Solicitud: En el fragmento de código proporcionado, se parsea el cuerpo de la solicitud en caso de que el método HTTP no sea GET ni POST. Esto se hace para manejar datos de solicitud en otros métodos HTTP, como PUT o DELETE.

// Ejecución de Acciones: Si se encuentra una coincidencia de ruta y método HTTP, el código itera a través de las acciones asociadas a esa ruta y las ejecuta. Cada acción puede ser una función o un método que realiza alguna lógica específica en respuesta a la solicitud.

// Código de Respuesta 404: Si no se encuentra ninguna coincidencia en las rutas definidas, se establece el código de respuesta HTTP en 404, lo que indica que la ruta no ha sido encontrada.