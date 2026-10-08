<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Core\Database\Connection;
use App\Core\Database\Database;
use App\Core\MVC\View;
use App\Core\Routing\Router;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Services\CategoryService;
use App\Services\PostService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$dbConfig = require __DIR__ . '/../config/db.php';
$smartyConfig = require __DIR__ . '/../config/smarty.php';

$db = Database::connect($dbConfig['db']);

View::init($smartyConfig['smarty']);

$router = new Router();

$connection = new Connection();

$categoryRepository = new CategoryRepository($connection);
$categoryService = new CategoryService($categoryRepository);

$postRepository = new PostRepository($connection);
$postService = new PostService($postRepository);

$homeController = new HomeController($categoryService, $postService);
$categoryController = new CategoryController($categoryService, $postService);
$postController = new PostController($postService);

$router->get('/', fn() => $homeController->index());
$router->get('/category', fn() => $categoryController->show((int)($_GET['id'] ?? 0)));
$router->get('/post', fn() => $postController->show((int)($_GET['id'] ?? 0)));

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
