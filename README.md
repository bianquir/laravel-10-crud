# Simple Laravel 10 CRUD Application Tutorial
Learn how to develop a simple Laravel 10 CRUD application

> The complete tutorial step by step guide is available on my blog. [Laravel 10 CRUD Application](https://www.allphptricks.com/simple-laravel-10-crud-application/)

## Blog
https://www.allphptricks.com/


## Installation 
Make sure that you have setup the environment properly. You will need minimum PHP 8.1, MySQL/MariaDB, and composer.

1. Descarga el proyecto o clona usando Git.
2. Copia el archivo `.env.example` y crea un nuevo archivo nombrandolo `.env`. Luego, configura tu base de datos y credenciales dentro del archivo `.env`.
3. Ve al directorio raiz del proyecto utilizando la terminal/símbolo del sistema y ejecuta los siguientes comandos:
            `composer install`
             `npm install`
5. Configura la clave de aplicacion ejecutando `php artisan key:generate`.
6. Ejecuta el siguiente comando para migrar la base de datos:  `php artisan migrate`.
En caso de querer utilizar datos de prueba (seeders) ejecuta el comando:   `php artisan migrate --seed` 
7. Para iniciar el servidor , ejecuta el comando `php artisan serve`.
8. Abre tu navegador y visita la URL proporcionada una vez ejecutado el comando anterior (Suele aparecer como: http://localhost:8000).
9. Una vez dentro del proyecto en tu navegador, ve al apartado configuración, para establecer la configuración de tu sistema.
