# Мои версии
Docker Client:
 Version:           29.1.5
 API version:       1.52

# установка 

```bash
docker compose up -d --build
docker exec -it -u $(id -u):$(id -g) app bash
composer update
php artisan key:generate
php artisan migrate:fresh --seed
```

# Проверка установки
Проект: http://localhost:8087/

База данных:
http://localhost:8181/
Логин и пароль в .env
