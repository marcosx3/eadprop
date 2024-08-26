<?php
use App\Rotas\App\App;

require 'vendor/autoload.php';

require_once './src/Rotas/Routes.php';

$routes = require_once 'src/Rotas/Routes.php';

$app = new App();

$app->run($routes);

?>