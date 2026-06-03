Desafio Practico 03
DataAuditLabs — Sistema Web de Gestión de Tareas
Aplicación web para que los empleados de DataAudit Labs gestionen sus tareas personales de forma organizada y segura. 

Repositorio: https://github.com/Balc-Alex03/Desafio03-DSS-G03L

## Tecnologías utilizadas

- PHP 8.3 — Lógica del servidor (MVC nativo)
- MySQLi — Conexión a base de datos en el MVC nativo
- MySQL / MariaDB — Base de datos relacional
- Laravel 11 — CRUD de tareas (versión framework)
- AJAX / Fetch API — Cambio de estado sin recargar la página
- CSS puro — Estilos de la interfaz
- Laragon — Entorno de desarrollo local

## Requisitos previos

- [Laragon](https://laragon.org/) (incluye PHP 8.3, Apache y MySQL)
- [Composer](https://getcomposer.org/) v2.x
- Navegador moderno con soporte para Fetch API

## Estructura del proyecto

```
DataAuditLabs/
├── database/
│   └── QueryDesafio03.sql       # Script SQL de la base de datos
├── laravel_tareas/              # CRUD de tareas con Laravel
├── mvc_nativo/                  # Autenticación + CRUD + AJAX en PHP puro
│   ├── ajax/
│   │   └── actualizar_estado.php
│   ├── config/
│   │   └── Database.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── TareasController.php
│   ├── libs/
│   ├── models/
│   │   ├── TareasModel.php
│   │   └── UsuarioModel.php
│   ├── public/
│   │   ├── css/style.css
│   │   └── js/app.js
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── registro.php
│   │   ├── layout/
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   └── tareas/
│   │       ├── index.php
│   │       ├── crear.php
│   │       └── editar.php
│   ├── .htaccess
│   └── index.php
├── screenshots/
├── .gitignore
└── README.md

## Instalación y configuración

### 1. Clonar el repositorio

bash
```
git clone https://github.com/Balc-Alex03/Desafio03-DSS-G03L.git
cd DataAuditLabs
```
renombrar la carpeta raiz a "DataAuditLabs"

### 2. Crear la base de datos

Abre phpMyAdmin o HeidiSQL y ejecuta el script:

```
database/QueryDesafio03.sql
```

### 3. Configurar la conexión (MVC nativo)

Abre `mvc_nativo/config/Database.php` y ajusta las credenciales:

```
php
$host     = 'localhost';
$user     = 'root';
$password = '';
$database = 'db_desafio03';
```

### 4. Configurar la conexión (Laravel)

Copia el archivo de entorno y configura:

bash
```
cd laravel_tareas
cp .env.example .env
php artisan key:generate
```

Edita `.env` con tus credenciales de base de datos:

```
DB_DATABASE=db_desafio03
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Instalar dependencias de Laravel

bash
```
cd laravel_tareas
composer install
php artisan migrate
```

### 6. Acceder a la aplicación

| Módulo     | URL                                               |                                                 
|------------|---------------------------------------------------|
| MVC Nativo | `http://localhost/DataAuditLabs/mvc_nativo/`      |
| Laravel    | `http://localhost:8000` (con `php artisan serve`) |

---

## Funcionalidades implementadas

- Registro e inicio de sesión de usuarios con contraseña hasheada (`password_hash`)
- CRUD completo de tareas (crear, leer, editar, eliminar)
- Cada usuario ve únicamente sus propias tareas
- Cambio de estado de tarea **sin recargar la página** mediante AJAX
- Versión del CRUD de tareas en **Laravel** con Eloquent ORM
- Interfaz responsiva con CSS puro

---

## Declaración de uso de Inteligencia Artificial

| Herramienta | Parte del proyecto                    | Tipo de ayuda                                                              | ¿Entiende el código? |
|-------------|---------------------------------------|----------------------------------------------------------------------------|----------------------|
| Claude      | Planificación general y arquitectura  | Explicación del patrón MVC, flujo de la aplicación, estructura de carpetas | Sí                   |
| Claude      | Base de datos                         | Explicación de tipos de datos, claves foráneas y buenas prácticas SQL      | Sí                   |
| Claude      | config/Database.php                   | Explicación del patrón de clase estática para conexión MySQLi              | Sí                   |
| Claude      | Modelos y Controladores               | Revisión y depuración de errores, explicación de consultas preparadas      | Sí, modificado       |
| Claude      | AJAX                                  | Explicación del flujo fetch() → endpoint PHP → JSON → DOM                  | Sí, modificado       |
| Claude      | Depuración general                    | Resolución de errores de rutas con `__DIR__` y conflictos de `require_once`| Sí                   |
| Gemini      | CSS                                   | Diseño basico para el funcionamiento de la pagina                          | Ligeramente          |
|             |                                       |                                                                            |                      |
| Claude      | README                                | Generacion de plantilla para el archivo README, declaracion por la misma   | Sí, modificado       |

Agregado: Claude ha servido como un orientador y fue utilizado meramente como apoyo, siendo que se le pidio que siguiera las politicas de uso. 
          No se genero codigo directo, sino que su ayuda se baso en explicaciones y propuestas de estructurado, con la exepcion de corecciones; Por ejemplo, el "__DIR__".  

          La declaracion de uso se le dejo a claude debido a que la misma es conciente de las politicas y se manejo toda esta informacion de forma transparente.
          Tambien me gustaria añadir que todos los archivos han sido editados por mi persona - incluyendo este reporte, dando mi palabra de que toda la informacion es veridica.

Declaramos que: todo el código entregado ha sido comprendido, modificado cuando fue necesario, y podemos explicar su funcionamiento en la defensa.

Firma del integrante 1: BH241800

---

## Autores

- Diego Alexander Balcáceres Hernández | BH241800

Universidad Don Bosco, Facultad de Ingeniería — 2026
