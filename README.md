# Documentación

## Sobre el proyecto

Puede visualizar la aplicación en producción [Aquí](https://challengewyleex.darmsportfolio.xyz)

## Sobre el proyecto

Este repositorio contiene un proyecto Laravel para ser utilizado en carácter de prueba técnica.
En términos generales, la aplicación relaciona lectores y con noticias.
Cada entidad (lectores y administradores) tiene la posibilidad de identificarse en la aplicación web y dependiendo de su rol dentro de la misma podrá: o solo ver noticias, o crearlas, modificarlas, gestionar redactores, visualizar estadísticas.
También, los usuarios administradores tendrán acceso a los EndPoints.
Éstos EndPoints están securizados mediante JWT y proporcionan información útil sobre lectores, noticias.
Puede revisar la documentación de los EndPoints en: 
[Documentación EndPoints](https://challengewyleex.darmsportfolio.xyz/api/documentation)

## Requerimientos
* PHP >= ^8.1
* [Composer](https://github.com/composer/composer) ^2.5.4
* [Laravel](https://github.com/laravel/framework) ^10.1.1
* [jwt-auth](https://github.com/tymondesigns/jwt-auth) ^2.0.2
* [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger) ^8.5
* [sweet-alert](https://github.com/realrashid/sweet-alert) ^6.0.0
* [MySQL](https://dev.mysql.com/) ^8.0.27

## Características
* [Bootstrap](https://getbootstrap.com/docs/5.2/getting-started/introduction/) ^5.2.3


## Instalación

- Clonar repositorio
- Configurar archivo .env usando como base el archivo .env.example (Importante: Configurar MAIL_HOST con su proveedor preferido. En entornos de prueba, puede utilizar [Mailtrap](https://mailtrap.io/))
- Estando posicionado dentro del proyecto, abrir terminal y ejecutar:


    ```bash
    $ composer update
    $ php artisan key:generate
    $ php artisan jwt:secret
    $ php artisan l5-swagger:generate
    $ php artisan migrate
	$ php artisan db:seed
	$ php artisan serve
    ```

- Dirijase a  `localhost` o `http://127.0.0.1:8000` (según sea su caso en particular) y realice las pruebas

## Esquema de base de datos

<img src="https://raw.githubusercontent.com/darmstedgio/challengeWyleex/master/public/assets/images/challengeWyleexDB.jpeg" alt="challengeWyleexDB">