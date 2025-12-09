#Installation proccess

1. clone the project.
2. remove .example from .env.example
3. run composer install for installation packages .
4. run composer dump-autoload for autoload.
5. run php artisan key:generate for generate app key
6. run php artisan migrate for database table creation.
7. run php artisan serve to start project locally. and should get local url like http://127.0.0.1:8000
8. hit http://127.0.0.1:8000/api
9. if you see the text "Task app API is up and running...". than yeah app is running.
