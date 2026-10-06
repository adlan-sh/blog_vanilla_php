<?php

use App\Core\Database\Database;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = require __DIR__ . '/config/db.php';
$db = Database::connect($config['db']);

$db->exec("SET FOREIGN_KEY_CHECKS=0");
$db->exec("TRUNCATE post_category");
$db->exec("TRUNCATE posts");
$db->exec("TRUNCATE categories");
$db->exec("SET FOREIGN_KEY_CHECKS=1");

// Категории
$cats = [
    ['PHP',        'Всё о серверном языке PHP'],
    ['JavaScript', 'Фронтенд, Node.js и всё вокруг JS'],
    ['DevOps',     'Docker, CI/CD, инфраструктура'],
    ['Базы данных','SQL, NoSQL и оптимизация'],
];
$insCat = $db->prepare("INSERT INTO categories (title, description) VALUES (?, ?)");
foreach ($cats as $c) $insCat->execute($c);

// Статьи
$posts = [
    ['Чистый PHP без фреймворков', 'assets/img/php.jpg',
        'Как построить маленький сайт на голом PHP.',
        'В этой статье разберём структуру проекта, автозагрузку, роутер и работу с PDO.',
        ['PHP'], 120, '2024-01-10 10:00:00'],

    ['Smarty за 10 минут', 'assets/img/smarty.jpg',
        'Быстрый старт с шаблонизатором Smarty.',
        'Установка, наследование шаблонов, блоки, циклы и экранирование.',
        ['PHP'], 87, '2024-02-05 12:00:00'],

    ['Современный JavaScript', 'assets/img/js.jpg',
        'ES2023 и что нового.',
        'Модули, async/await, top-level await, приватные поля классов.',
        ['JavaScript'], 210, '2024-03-01 09:00:00'],

    ['Docker для PHP-разработчика', 'assets/img/docker.jpg',
        'Поднимаем окружение за 5 минут.',
        'docker-compose, nginx, php-fpm, mysql, volume и env-переменные.',
        ['DevOps', 'PHP'], 340, '2024-03-20 14:00:00'],

    ['Индексы в MySQL', 'assets/img/mysql.jpg',
        'Когда индекс ускоряет, а когда тормозит.',
        'B-tree, cardinality, покрывающие индексы и EXPLAIN.',
        ['Базы данных'], 155, '2024-04-02 11:00:00'],

    ['Связи многие-ко-многим', 'assets/img/many.jpg',
        'Как устроить связь M:N.',
        'Промежуточная таблица, каскады, JOIN и агрегаты.',
        ['Базы данных', 'PHP'], 90, '2024-04-15 16:00:00'],

    ['CI/CD на GitHub Actions', 'assets/img/ci.jpg',
        'Автоматизируем деплой.',
        'YAML-воркфлоу, секреты, кеширование и матрицы.',
        ['DevOps'], 66, '2024-05-01 08:00:00'],

    ['Асинхронность в JS', 'assets/img/async.jpg',
        'Event loop простыми словами.',
        'Стек вызовов, микро- и макротаски, промисы.',
        ['JavaScript'], 178, '2024-05-12 13:00:00'],
];

$insPost = $db->prepare("
    INSERT INTO posts (title, image, description, content, views, published_at)
    VALUES (?, ?, ?, ?, ?, ?)
");
$link = $db->prepare("
    INSERT INTO post_category (post_id, category_id)
    VALUES (?, (SELECT id FROM categories WHERE title = ?))
");

foreach ($posts as $p) {
    [$title, $img, $desc, $content, $catNames, $views, $date] = $p;
    $insPost->execute([$title, $img, $desc, $content, $views, $date]);
    $postId = (int)$db->lastInsertId();

    foreach ($catNames as $cn) {
        $link->execute([$postId, $cn]);
    }
}

echo "Готово: " . count($cats) . " категорий, " . count($posts) . " статей.\n";