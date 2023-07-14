Запуск происходит при использовании команды docker-compose up -d --build
Затем необходимо запустить миграции и сидеры  docker-compose exec app php artisan migrate --seed
После добавления пользователя можно проверить, что добавилось уведомление через запрос getNotifications


