# Sistema de Inventario de Productos - Proyecto SOF-109

Este proyecto consiste en un **CRUD** (Operaciones de Crear, Leer, Actualizar y Borrar datos) diseñado para gestionar las entradas de un inventario de productos y permitir que los clientes consulten la disponibilidad de forma segura.

## 📋 Información Académica
**Institución:** Instituto Técnico Superior Comunitario (ITSC)  
**Carrera:** Desarrollo de Software  
**Asignatura:** SOF-109 - Desarrollo Web  
**Profesor:** Carlos Adames  

### 👥 Integrantes
| Nombre | Matrícula |
| :--- | :--- |
| **Luis Díaz** | 2023-0240 |
| **Ronald Reyes** | 2024-1649 |

---

## 🚀 Descripción General
El sistema permite llevar un control detallado de los productos y sus existencias. Cuenta con dos niveles de acceso:
1.  **Administrador:** Puede realizar la gestión completa de productos (añadir, editar, eliminar y ver existencias).
2.  **Cliente:** Tiene acceso de solo lectura para visualizar el inventario disponible.

El sistema implementa un **Login** (Inicio de sesión) seguro utilizando la encriptación **Argon2** (el algoritmo más moderno y seguro actualmente para proteger contraseñas), garantizando la integridad de las cuentas de usuario.

---

## 🛠️ Requisitos Técnicos
Para el desarrollo y despliegue del sistema se utilizaron las siguientes herramientas:

* **XAMPP:** Paquete de software que facilita la instalación de **Apache** (Servidor web), **PHP** (Lenguaje de programación del lado del servidor) y **MySQL** (Sistema de gestión de bases de datos).
* **PHP Server:** Extensión del **IDE** Visual Studio Code para previsualizar el proyecto.
* **Base de Datos:** MySQL gestionado a través de **phpMyAdmin**.
* **Bootstrap:** **Librería de CSS** utilizada para un diseño rápido y responsivo.
* **Arquitectura MVC:** Estructura de software **Modelo-Vista-Controlador** para mantener un código organizado.
* **Control de Versiones:** Git y GitHub para el seguimiento del código.

## ⚙️ Instalación y Ejecución

### Opción 1: Usando XAMPP (Recomendado)
1.  **Descargar el proyecto:** Clona o descarga este repositorio en la carpeta `C:/xampp/htdocs/`.
2.  **Preparar la Base de Datos:**
    * Abre el Panel de Control de XAMPP e inicia **Apache** y **MySQL**.
    * Haz clic en "Admin" en la fila de MySQL para abrir **phpMyAdmin**.
    * Crea una base de datos nueva llamada `inventario_db`.
    * Importa el archivo `inv.sql` incluido en el proyecto para crear las tablas y relaciones.
3.  **Ejecutar:** Abre tu navegador y escribe `http://localhost/(nombre-de-tu-carpeta)/index.php`.

### Opción 2: Usando PHP Server en VS Code
1.  Abre la carpeta del proyecto en **Visual Studio Code**.
2.  Asegúrate de tener instalada la extensión **PHP Server**.
3.  Haz clic derecho sobre `index.php` y selecciona **"Start Server"**.
4.  El sistema se abrirá automáticamente en tu navegador predeterminado.

> [!IMPORTANT]
> **Acceso Administrador:** Para registrarte como administrador, debes ingresar el código de seguridad: **554786** en el campo correspondiente del formulario de registro.

---

## ✨ Buenas Prácticas Aplicadas
* **Seguridad de Acceso:** Redirección automática al Login para usuarios no autenticados, protegiendo las rutas internas del sistema.
* **Seguridad de Datos:** Implementación de **Argon2** para el cifrado de credenciales.
* **Validaciones Duales:** Validación de datos tanto en el cliente (navegador) como en el servidor para prevenir ataques o errores de datos inválidos.
* **Experiencia de Usuario (UX):** Uso de **JQuery** (Librería de JavaScript) para permitir la navegación entre campos obligatorios usando la tecla "Enter".
* **Modularización:** Uso de carpetas específicas como `views/modals` para separar componentes visuales y mejorar la mantenibilidad del código.