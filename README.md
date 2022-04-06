Для развертывания проекта необходимо скачать его из репозитория

Далее в корне проекта скопировать файл .env.example в файл .env В этом файле указать актуальные настройки для связи с БД
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=

Так же нужно указать корректный апи токен который будет использоваться в качестве аутентификатора

- API_TOKEN

После этого нужно загрузить/обновить все зависимости проекта командой ***composer install***

Далее выполнить миграцию ***php artisan migrate***

Чтобы заполнить БД тестовыми данными можно запустить seeder: ***php artisan db:seed --class=ArticleTagSeeder***

Для теста Api ссылка на [Postman](https://www.getpostman.com/collections/efc6b0189a09bc30a379)
