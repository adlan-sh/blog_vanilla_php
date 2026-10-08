# Тестовое задание Blog Vanilla PHP

Для запуска проекта необходимо:
1. Создать файл `.env` и заполнить его значениями переменных окружения (можно взять пример из `.env.example`)
2. Запустить контейнеры: `docker compose up -d`
3. Установить зависимости composer: `docker compose exec php composer install`
4. Заполнить БД данными: `docker compose exec php php seed.php`