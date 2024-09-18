# [Создать JSON API для сайта объявлений](https://n1creator.com/whnexttestphp.html)

### Проект деплоится командой:  
`docker compose up --build -d`

### Реализованы следующие эндпоинты:  
- `POST` `http://localhost/api/v1/ads/` – Получение конкретного объявления по ID
- `POST` `http://localhost/api/v1/ads/list` - Получение пагинированного списка объявлений
- `POST` `http://localhost/api/v1/ads/create` - Создание нового объявления

### Для запуска тестов:  
`docker compose exec php-fpm php artisan test`  

### Также необходимо:  
- скопировать `.env` файл в корне проекта из `.env.example`  
- скопировать `microservice/.env` из `microservice/.env.example`