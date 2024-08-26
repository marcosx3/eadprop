<?php
namespace App\Rotas\App;

class App {
    public function run($routes) {
        $uri = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];

        // Verifica se a rota existe
        foreach($routes as $route => $action) {
            if( preg_match('#^' . $route . '$#', $uri, $matches)) {
                // Separa a rota em partes
                $parts = explode("/",$route);
                $controller = ucfirst($parts[0]);
                $method = lcfirst($parts[1]);

                // Extrai os parametros da rota
                $params = array();
                foreach( $matches as $key => $value ){
                    if ( $key > 0 ) { // Ignora o primeiro elemento ( a rota completa )
                        $params[$key - 1] = $value;
                    }   
                }
                // Instancia o controler e executa o metodo
                $controller = new $controller();
                call_user_func_array(array($controller,$method), $params);
                return;
            }
        }
        //se a rota não existir
        header('HTTP/1.0 404 NOT FOUND');
        echo 'Pagina não encontrada';
        exit;
    }
}