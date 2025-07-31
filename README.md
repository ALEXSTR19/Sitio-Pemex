# Sitio PEMEX

Este proyecto es un sitio web simple desarrollado en PHP. Incluye un formulario de inicio de sesión que valida las credenciales contra una base de datos MySQL. El portal cuenta con secciones de Historia, Misión, Principios y nuevas páginas de **Servicios** y **Transparencia** para consultar la información corporativa esencial.

## Configuraci\xC3\xB3n de la base de datos

1. Crea una base de datos MySQL y un usuario con permisos. Las credenciales por defecto se encuentran en `conexion.php`.
2. Ejecuta el script `sql/setup.sql` para crear las tablas necesarias (`usuarios`, `vacantes` y `aplicaciones`) e insertar un usuario de ejemplo.

```bash
mysql -u <usuario> -p < sql/setup.sql
```

El usuario de ejemplo se llama `admin` y la contrase\xC3\xB1a es `admin123`.

## Uso

- Accede a `login.php` e introduce las credenciales.
- Tras iniciar sesi\xC3\xB3n se muestra el `dashboard.php`, donde podr\xC3\xA1s administrar las vacantes. Desde este panel puedes agregar, editar y eliminar registros. En el men\xC3\xBA lateral tambi\xC3\xA9n tienes acceso a `aplicaciones.php` para consultar las solicitudes recibidas.

