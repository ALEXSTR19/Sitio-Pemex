# Sitio PEMEX

Este proyecto es un sitio web simple desarrollado en PHP. Incluye un formulario de inicio de sesi\xC3\xB3n que valida las credenciales contra una base de datos MySQL.

## Configuraci\xC3\xB3n de la base de datos

1. Crea una base de datos MySQL y un usuario con permisos. Las credenciales por defecto se encuentran en `conexion.php`.
2. Ejecuta el script `sql/setup.sql` para crear las tablas necesarias (`usuarios` y `vacantes`) e insertar un usuario de ejemplo.

```bash
mysql -u <usuario> -p < sql/setup.sql
```

El usuario de ejemplo se llama `admin` y la contrase\xC3\xB1a es `admin123`.

## Uso

- Accede a `login.php` e introduce las credenciales.
- Al iniciar sesi\xC3\xB3n exitosamente podr\xC3\xA1s consultar `vacantes_internas.php`.

