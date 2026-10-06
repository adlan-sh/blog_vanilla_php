<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{block name=title}Блог{/block}</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <a href="/" class="logo">Блог</a>
</header>

<main class="container">
    {block name=content}{/block}
</main>

<footer class="site-footer">© {$smarty.now|date_format:"%Y"} Блог Vanilla PHP</footer>
</body>
</html>