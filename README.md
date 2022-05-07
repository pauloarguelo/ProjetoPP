# Projeto PP

1. Micro-Framework Lumen PHP 
2. PHP >= 8.0
3. MySQL 


## Apidoc

```
npm install apidoc -g
```

## Adminer - Mysql

http://localhost:8080

## commandos make 
```
make build
make up
make stop
make bash
```

## Notification Queue

```
make queue 
```

## Artisan
```
php artisan make:migration create_users_table --create=users
php artisan make:seeder UsersSeeder

php artisan migrate:fresh --seed

```