<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Core\Router;
use App\Core\View;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$dbConfig = require __DIR__ . '/../config/db.php';
$smartyConfig = require __DIR__ . '/../config/smarty.php';

$db = Database::connect($dbConfig['db']);

View::init($smartyConfig['smarty']);

$router = new Router();

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
