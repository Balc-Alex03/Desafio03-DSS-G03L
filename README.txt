Desafio Practico 03
DataAuditLabs — Sistema Web de Gestión de Tareas
Aplicación web para que los empleados de DataAudit Labs gestionen sus tareas personales de forma organizada y segura.

Repositorio: https://github.com/Balc-Alex03/Desafio03-DSS-G03L

---

# Tecnologías utilizadas

- PHP 8.3 — Lógica del servidor (MVC nativo)
- MySQLi — Conexión a base de datos en el MVC nativo
- MySQL / MariaDB — Base de datos relacional
- Laravel 11 — CRUD de tareas (versión framework)
- AJAX / Fetch API — Cambio de estado sin recargar la página
- CSS puro — Estilos de la interfaz
- Laragon — Entorno de desarrollo local

---

# Requisitos previos

- [Laragon](https://laragon.org/) (incluye PHP 8.3, Apache y MySQL)
- [Composer](https://getcomposer.org/) v2.x
- Navegador moderno con soporte para Fetch API

---

# Estructura del proyecto

DataAuditLabs/
├── database/
│   └── QueryDesafio03.sql          
├── laravel_tareas/                
│   ├── app/
│   │   ├── Http/Controllers/
│   │   │   └── TareaController.php
│   │   └── Models/
│   │       └── Tarea.php
│   ├── database/migrations/
│   ├── resources/views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   └── tareas/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       └── edit.blade.php
│   ├── public/
│   │   ├── css/style.css
│   │   └── js/app.js
│   └── routes/web.php
├── mvc_nativo/                     
│   ├── ajax/
│   │   └── actualizar_estado.php
│   ├── config/
│   │   └── Database.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── TareasController.php
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

---

# Instalación y configuración

 1. Clonar el repositorio

bash:
git clone https://github.com/Balc-Alex03/Desafio03-DSS-G03L.git

Renombrar la carpeta raíz a `DataAuditLabs` y colocarla en `C:\laragon\www\`.

# 2. Crear la base de datos

Abrir phpMyAdmin y ejecutar el script:
database/QueryDesafio03.sql

# 3. Configurar la conexión (MVC nativo)

Abrir `mvc_nativo/config/Database.php` y ajustar las credenciales:

$host     = 'localhost';
$user     = 'root';
$password = '';
$database = 'db_desafio03';


# 4. Configurar la conexión (Laravel)

bash:
cd DataAuditLabs/laravel_tareas
cp .env.example .env
php artisan key:generate


Editar `.env` con las credenciales de la base de datos:

DB_CONNECTION=mysql

DB_DATABASE=db_desafio03
DB_USERNAME=root
DB_PASSWORD=


# 5. Instalar dependencias de Laravel

bash:
cd DataAuditLabs/laravel_tareas
composer install
php artisan migrate

# 6. Acceder a la aplicación

| Módulo     | URL                                                                 |                                                 
|------------|---------------------------------------------------------------------|
| MVC Nativo | `http://localhost/DataAuditLabs/mvc_nativo/`                        |
| Laravel    | `http://localhost:8000/tareas` (ejecutar en bash: php artisan serve)|

> Nota: Primero registrar un usuario en el MVC nativo antes de usar Laravel, ya que ambos comparten la misma base de datos y Laravel utiliza la sesión iniciada en el MVC nativo.

---

# Funcionalidades implementadas

- Registro e inicio de sesión de usuarios con contraseña hasheada (`password_hash`)
- CRUD completo de tareas (crear, leer, editar, eliminar) en PHP nativo
- Cada usuario ve únicamente sus propias tareas
- Cambio de estado de tarea sin recargar la página mediante AJAX 
- CRUD de tareas en Laravel con Eloquent ORM y vistas Blade
- AJAX de cambio de estado integrado también en Laravel
- Interfaz con CSS puro compartida entre ambos módulos

---

# Declaración de uso de Inteligencia Artificial

| Herramienta | Parte del proyecto                             | Tipo de ayuda                                                                                                   | ¿Entiende el código?                                       |
|-------------|------------------------------------------------|-----------------------------------------------------------------------------------------------------------------|------------------------------------------------------------|
| Claude      | Planificación general y arquitectura           | Explicación del patrón MVC, flujo de la aplicación, estructura de carpetas                                      | Sí                                                         |
| Claude      | Base de datos                                  | Explicación de tipos de datos, claves foráneas y buenas prácticas SQL                                           | Sí                                                         |
| Claude      | config/Database.php                            | Explicación del patrón de clase estática para conexión MySQLi                                                   | Sí                                                         |
| Claude      | Modelos y Controladores (MVC nativo)           | Revisión y depuración de errores, explicación de consultas preparadas                                           | Sí, modificado                                             |
| Claude      | AJAX                                           | Explicación del flujo fetch() → endpoint PHP → JSON → DOM                                                       | Sí, modificado                                             |
| Claude      | Laravel (TareaController, rutas, vistas Blade) | Se proporcionó código base con explicación de la estructura; similar al MVC nativo pero con sintaxis de Laravel | Estructura comprendida, sintaxis en proceso de aprendizaje |
| Claude      | Depuración general                             | Resolución de errores de rutas con `__DIR__`, conflictos de `require_once`, errores de migración                | Sí                                                         |
| Gemini      | CSS                                            | Diseño básico para el funcionamiento de la página                                                               | Ligeramente                                                |
|             |                                                |                                                                                                                 |                                                            |
| Claude      | README                                         | Generación de plantilla y declaración de uso de IA                                                              | Sí, modificado                                             |

Agregado sobre el uso de la IA: 

Claude ha servido como un orientador y fue utilizado meramente como apoyo, siendo que se le pidio que siguiera las politicas de uso. 
No se generó código completo de forma directa, sino que la ayuda se basó en explicaciones, propuestas de estructura y correcciones especificas. 

La excepción fue en el módulo de Laravel, donde se proporcionó código base debido al desconocimiento y dificultad del framework, pero al final su estructura fue comprendida por su similitud con el MVC nativo. 
La declaracion de uso se le dejo a Claude debido a que la misma es conciente de las politicas y se manejo toda esta informacion de forma transparente.
Tambien me gustaria añadir que todos los archivos han sido editados por mi persona - incluyendo este reporte, dando mi palabra de que toda la informacion es veridica.

Declaramos que: todo el código entregado ha sido comprendido en la medida de lo posible, modificado cuando fue necesario, y podemos explicar su funcionamiento en la defensa.

Firma del integrante 1: BH241800

---

## Autores

- Diego Alexander Balcáceres Hernández | BH241800

Universidad Don Bosco, Facultad de Ingeniería — 2026