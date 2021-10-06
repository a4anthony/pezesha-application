[comment]: <> (<p align="center">)

[comment]: <> (  <img src="https://github.com/a4anthony/coupon/blob/master/Resources/assets/images/add.png?raw=true" width="300"/>)

[comment]: <> (  <img src="https://github.com/a4anthony/coupon/blob/master/Resources/assets/images/edit.png?raw=true" width="300" /> )

[comment]: <> (</p>)

## Getting started

1. Install composer dependencies
```
composer install
```

2. copy .env.example to .env

3. In .env, update database credentials
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pezesha
DB_USERNAME=root
DB_PASSWORD=
```

4. In .env, update QUEUE_CONNECTION as below
```
QUEUE_CONNECTION=database
```

5. In .env, add Marvel you api credentials
```
MARVEL_PRIVATE_KEY=
MARVEL_PUBLIC_KEY=
```

6. Run migrations
```
php artisan migrate
```

7. Run storage link
```
php artisan storage:link
```

8. Start queue work
```
php artisan queue:work
```

9. Install and build npm dependencies
```
npm install && npm run dev
```

10. Start your server and visit the link
```
php artisan serve
```

