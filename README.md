

# 🗂️ Task Master

**Task Master** es una aplicación web tipo **CRUD** para gestionar tareas personales. Permite registrar, visualizar, modificar y eliminar tareas mediante una interfaz clara, funcional y amigable. Está desarrollada con un **framework propio en PHP** siguiendo el patrón **MVC** y utilizando tecnologías web modernas.

---

## 🧩 Tabla de Contenidos

* [📌 Descripción](#-descripción)
* [🎯 Objetivos](#-objetivos)
* [🛠️ Funcionalidades](#-funcionalidades)
* [🔧 Tecnologías utilizadas](#-tecnologías-utilizadas)
* [⚙️ Guía de instalación](#-guía-de-instalación)
* [📁 Estructura del proyecto](#-estructura-del-proyecto)
* [🚀 Ejemplos de uso](#-ejemplos-de-uso)
* [🔭 Proyecciones futuras](#-proyecciones-futuras)
* [👥 Autores](#-autores)

---

## 📌 Descripción

Task Master nace como solución a la necesidad de organizar tareas personales o académicas. La aplicación permite crear tareas con campos clave (título, descripción, fecha, estado) y ofrece filtros para un mejor seguimiento. Utiliza un framework MVC creado desde cero con PHP y se complementa con tecnologías frontend modernas.

---

## 🎯 Objetivos

### Objetivo general

Desarrollar una aplicación web CRUD funcional que permita gestionar tareas usando buenas prácticas de desarrollo web estructurado.

### Objetivos específicos

* Implementar operaciones CRUD (Create, Read, Update, Delete).
* Aplicar el patrón MVC con separación de responsabilidades.
* Diseñar una interfaz clara usando Bootstrap.
* Documentar el proceso y el código.
* Usar librerías para mejorar la experiencia de usuario.

---

## 🛠️ Funcionalidades

### Básicas

* Crear tareas con campos: título, descripción, fecha límite, estado.
* Visualizar un listado completo de tareas.
* Editar tareas existentes.
* Eliminar tareas.

### Avanzadas

* Filtro por estado: pendiente, en proceso, completado.
* Confirmaciones y alertas visuales con SweetAlert2.
* Validaciones dinámicas con jQuery.

---

## 🔧 Tecnologías utilizadas

| Área          | Tecnología                        |
| ------------- | --------------------------------- |
| Frontend      | HTML5, CSS3, Bootstrap 4, jQuery  |
| Backend       | PHP 8.1.23 (framework propio MVC) |
| Base de datos | MySQL (PDO)                       |
| UI/UX         | SweetAlert2                       |
| Servidor      | Apache (XAMPP recomendado)        |

---

## ⚙️ Guía de instalación

### Requisitos

* PHP 8.1 o superior
* Servidor Apache (XAMPP recomendado)
* MySQL
* Navegador actualizado

### Pasos

1. **Clona este repositorio**:

```bash
git clone https://github.com/tu_usuario/task-master.git
```

2. **Coloca el proyecto en el directorio `htdocs` de XAMPP**:

```bash
mv task-master /c/xampp/htdocs/
```

3. **Crea la base de datos**:

   * Abre **phpMyAdmin**
   * Crea una nueva base de datos llamada `task_master`
   * Importa el archivo `database.sql` si está disponible o crea la tabla `tasks` manualmente:

```sql
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100),
  descripcion TEXT,
  fecha DATE,
  estado ENUM('pendiente', 'proceso', 'completado') DEFAULT 'pendiente'
);
```

4. **Configura tu archivo `config.php` con tus credenciales**:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'task_master');
define('DB_USER', 'root');
define('DB_PASS', '');
```

5. **Abre tu navegador en**:

```
http://localhost/task-master/app/public
```

---

## 📁 Estructura del proyecto

```plaintext
task-master/
├── app/
│   ├── public/               # Archivos visibles (index.php, assets)
│   ├── controllers/          # Lógica del sistema (TasksController.php)
│   ├── models/               # Lógica de base de datos (DB.php, tasks.php)
│   ├── resources/
│   │   ├── views/            # Vistas (create_task.view.php, etc.)
│   │   └── layouts/          # Plantillas base (main_head.php, etc.)
│   ├── classes/              # Core del framework (Router.php, Autoloader.php)
│   ├── config.php            # Configuración de DB
│   └── app.php               # Inicializador del sistema
```

---

## 🚀 Ejemplos de uso

### Crear una nueva tarea

1. Ingresa a `/tasks/create`
2. Llena los campos: título, descripción, fecha, estado
3. Haz clic en **Guardar**

### Ver lista de tareas

* En la vista principal `/tasks`, se muestra un listado general con opciones para editar o eliminar cada tarea.

### Editar una tarea

* Desde la lista, selecciona el ícono de editar
* Modifica los campos necesarios
* Guarda los cambios

---

## 🔭 Proyecciones futuras

* 🧑‍💻 Autenticación de usuarios
* 📨 Notificaciones por email o push
* 🧑‍🤝‍🧑 Tareas colaborativas
* 📅 Sincronización con calendarios externos
* 📱 App móvil con Flutter o React Native
* 🔌 API RESTful para acceso externo

---

## 👥 Autores

* **Alan Eduardo González González**
* **Victor Josue Larios Rosas**
---

> Si encuentras útil este proyecto, ¡dale ⭐ en GitHub y colabora con mejoras!

---

