# Laravel MENU 🤓

## Comenzando 💪🚀

Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas.

### Pre-requisitos 📋

_Que cosas necesitas para poner en marcha el proyecto y como instalarlos_

* GIT [Link](https://git-scm.com/downloads)
* Entorno de servidor local, Ej: [Laragon](https://laragon.org/download/), [XAMPP](https://www.apachefriends.org/es/index.html) o [LAMPP](https://bitnami.com/stack/lamp/installer).
* PHP Version 7.4 - 8.0 [Link](https://www.php.net/downloads.php).
* Manejador de dependencias de PHP [Composer](https://getcomposer.org/download/).

### Instalación 🔧

Paso a paso de lo que debes ejecutar para tener el proyecto ejecutandose

 1. Primero que nada, clic en Fork 😊
 2. Inicia el git dentro de tu servidor:
    ```
    git init
    ```
 3. Luego, clona el repositorio dentro de la carpeta de tu servidor con el siguiente comando:
    ```
    git clone https://github.com/susananzth/red-laravel.git
    ```
 4. Ingresa a la carpeta del repositorio
    ```
    cd repositorio
    ```
 5. Instala las dependencias del proyecto
    ```
    composer install
    ```
 5. Crea el archivo ".env" copiando la información del [ejemplo](https://github.com/susananzth/3-laravel-crud/blob/main/.env.example) y cambiar valores de su Base de datos.
 6. Ejecute las migraciones
    ```
    php artisan migrate --seed
    ```
 7. Inicialice el servidor local
    ```
    php artisan serve
    ```
 8. Listo, ya podrá visualizr e interactuar con el proyecto en local  😁

## Construido con 🛠️

Las herramientas que utilice para crear este proyecto

* Framework de PHP [Laravel](https://laravel.com/docs/5.8).
* Toolkit de diseño [Bootstrap](https://getbootstrap.com/docs/4.1/getting-started/introduction/).

## Autores ✒️

* **Susana Piñero** - *FrontEnd + Backend + Documentación* - GitLab: [susananzth](https://gitlab.com/susananzth) GitHub: [susananzth](https://github.com/susananzth)

## Licencia 📄

Este proyecto está bajo la Licencia (GNU General Public License v3.0) - mira el archivo [LICENSE.md](https://github.com/susananzth/red-laravel/blob/main/LICENSE) para detalles

## Expresiones de Gratitud 🎁

* Comenta a otros sobre este proyecto 📢
* Regalame una estrella ⭐
* Copia el proyecto en tu cuenta dando clic en Fork 😊