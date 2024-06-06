## Instalacion

1. Descarga el proyecto o clona usando Git.
2. Copia el archivo `.env.example` y crea un nuevo archivo nombrandolo `.env`. Luego, configura tu base de datos y credenciales dentro del archivo `.env`.
3. Ve al directorio raiz del proyecto utilizando la terminal/símbolo del sistema y ejecuta los siguientes comandos:
            `composer install`
             `npm install`
5. Configura la clave de aplicacion ejecutando `php artisan key:generate`.
6. Ejecuta el siguiente comando para migrar la base de datos:  `php artisan migrate`.
En caso de querer utilizar datos de prueba (seeders) ejecuta el comando:   `php artisan migrate --seed` 
7. Ejecuta el comando `npm run dev`.
8. Para iniciar el servidor , ejecuta el comando `php artisan serve`.
9. Abre tu navegador y visita la URL proporcionada una vez ejecutado el comando anterior (Suele aparecer como: http://localhost:8000).
10. Una vez dentro del proyecto en tu navegador, ve al apartado configuración, para establecer la configuración de tu sistema.
